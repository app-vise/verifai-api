<?php

namespace Tests\Integration;

use Appvise\Verifai\Exception\NotAuthenticatedException;
use Appvise\Verifai\Exception\NotFoundException;
use Appvise\Verifai\Exception\VerifaiApiException;
use Appvise\Verifai\Http\Adapter\Guzzle\GuzzleClient;
use Appvise\Verifai\Http\Body;
use Appvise\Verifai\Http\ClientInterface;
use Appvise\Verifai\Http\VerifaiResponse;
use Appvise\Verifai\Model\Data;
use Appvise\Verifai\Model\Family;
use Appvise\Verifai\Model\IdentifierUUID;
use Appvise\Verifai\Model\IdentityDocument;
use Appvise\Verifai\Model\Image;
use Appvise\Verifai\Model\OneTimePassword;
use Appvise\Verifai\Model\Person;
use Appvise\Verifai\Model\Personal;
use Appvise\Verifai\Model\ProfileUUID;
use Appvise\Verifai\Model\Report;
use Appvise\Verifai\Model\ROI;
use Appvise\Verifai\Model\Source;
use Appvise\Verifai\Model\VerifaiResult;
use Appvise\Verifai\VerifaiClient;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function it_should_fetch_an_access_token(): void
    {
        $mock = new MockHandler([
            new Response(
                200,
                [],
                '{
                "token": "1234567890",
                "expire": "05/29/2017 09:30:12 PM",
                "used": false
            }',
            ),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $client = new VerifaiClient(new GuzzleClient($client));
        $body = new Body('https://app.handelzeker.nl');
        $otp = $client->obtainOTP($body);
        $this->assertInstanceOf(OneTimePassword::class, $otp);
        $this->assertFalse($otp->hasBeenUsed());
        $this->assertEquals('1234567890', $otp->token());
        $this->assertEquals(DateTime::createFromFormat('d-m-y', '29-05-17')->format('d-m-y'), $otp->expires()->format('d-m-y'));
    }

    /** @test */
    public function it_should_throw_an_not_found_error_when_endpoint_does_not_exists(): void
    {
        $this->expectException(NotFoundException::class);
        $mock = new MockHandler([
            new RequestException(
                'Not found',
                new Request('GET', '/does-not-exists'),
                new Response(404, [], 'This page does not exists.')
            ),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $client = new VerifaiClient(new GuzzleClient($client));
        $client->getVerifaiResult(ProfileUUID::make('NOT_A_VALID_UUID'));
    }

    /** @test */
    public function it_should_throw_an_error_when_not_authenticated(): void
    {
        $this->expectException(NotAuthenticatedException::class);
        $mock = new MockHandler([
            new RequestException(
                'Not autenthicated',
                new Request('GET', '/'),
                new Response(401, [], '')
            ),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $client = new VerifaiClient(new GuzzleClient($client));
        $client->getVerifaiResult(ProfileUUID::make('NOT_A_VALID_UUID'));
    }

    /** @test */
    public function it_should_throw_a_verifai_exception_when_request_is_valid_but_not_processed_by_verifai(): void
    {
        $this->expectException(VerifaiApiException::class);
        $mock = new MockHandler([
            new RequestException(
                'Unprocessable entity',
                new Request('GET', '/'),
                new Response(422, [], 'Unprocessable entity')
            ),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $client = new VerifaiClient(new GuzzleClient($client));
        $client->getVerifaiResult(ProfileUUID::make('NOT_A_VALID_UUID'));
    }

    /** @test */
    public function dutch_specimen_passport_yields_verifai_result(): void
    {
        $dutchSpecimenPassportJson = file_get_contents(__DIR__ . '/../__Fixtures__/DutchSpecimenPassport.json');
        $stub = $this->createStub(ClientInterface::class);
        $stub->method('get')
            ->willReturn(
                new Response(
                    200,
                    [],
                    $dutchSpecimenPassportJson
                )
            );

        $client = new VerifaiClient($stub);
        $verifaiResponse = $client->getVerifaiResult(ProfileUUID::make('VALID_UUID'));
        $this->assertInstanceOf(VerifaiResponse::class, $verifaiResponse);
        $this->assertEquals(200, $verifaiResponse->getStatusCode());

        $verifaiResult = $verifaiResponse->getData();
        $this->assertInstanceOf(VerifaiResult::class, $verifaiResult);
        $this->assertInstanceOf(ProfileUUID::class, $verifaiResult->getUuid());
        $this->assertEquals("3fa85f64-5717-4562-b3fc-2c963f66afa6", $verifaiResult->getUuid()->getValue());
        $this->assertEquals("2022-04-13 13:38:45", $verifaiResult->getCreated()->format('Y-m-d H:i:s'));
        $this->assertEquals("your_internal_reference_id", $verifaiResult->getInternalReference());
        $this->assertEquals("completed", $verifaiResult->getProcessingStatus());

        $identityDocument = $verifaiResult->getIdentityDocument();
        $this->assertInstanceOf(IdentityDocument::class, $identityDocument);
        $data =  $identityDocument->getData();
        $this->assertInstanceOf(Data::class, $data);
        $this->assertEquals('NLD', $data->getCountry());
        $this->assertEquals('SPECI2014', $data->getDocumentNumber());
        $this->assertEquals('Groningen', $data->getPlaceOfIssue());
        $this->assertEquals('Burg. van Stad en Dorp', $data->getIssuingAuthority());
        $this->assertEquals('2022-04-13', $data->getDateOfExpiry()->format('Y-m-d'));
        $this->assertEquals('2022-04-13', $data->getDateOfIssue()->format('Y-m-d'));
        $this->assertCount(2, $data->getMrzLines());
        $this->assertEquals('P<NLDDE<BRUIJN<<WILLEKE<LISELOTTE<<<<<<<<<<<', $data->getMrzLines()[0]);
        $this->assertEquals('SPECI20142NLD6503101F2403096999999990<<<<<84', $data->getMrzLines()[1]);

        // @TODO assert pages function
        $pages = $identityDocument->getPages();
        $this->assertIsArray($pages);
        $this->assertCount(1, $pages);
        /** @var Image $imageCropped  */
        $imageCropped = $pages[0]->getImageCropped();
        /** @var Image $imageOriginal  */
        $imageOriginal = $pages[0]->getImageOriginal();
        $roi = $pages[0]->getROI();
        $type = $pages[0]->getType();
        $this->assertInstanceOf(Image::class, $imageCropped);
        $this->assertEquals(0, $imageCropped->getHeight());
        $this->assertEquals("jpg", $imageCropped->getMimeType());
        $this->assertEquals("img-url.com", $imageCropped->getUrl());
        $this->assertEquals(0, $imageCropped->getWidth());

        $this->assertInstanceOf(Image::class, $imageOriginal);
        $this->assertEquals(0, $imageOriginal->getHeight());
        $this->assertEquals("jpg", $imageOriginal->getMimeType());
        $this->assertEquals("img-url.com", $imageOriginal->getUrl());
        $this->assertEquals(0, $imageOriginal->getWidth());
        $this->assertInstanceOf(ROI::class, $roi);
        $this->assertEquals(1.0, $roi->getX1());
        $this->assertEquals(1.0, $roi->getX2());
        $this->assertEquals(1.0, $roi->getX3());
        $this->assertEquals(1.0, $roi->getX4());
        $this->assertEquals(1.0, $roi->getY1());
        $this->assertEquals(1.0, $roi->getY2());
        $this->assertEquals(1.0, $roi->getY3());
        $this->assertEquals(1.0, $roi->getY4());
        $this->assertEquals("primary", $type);

        $report = $identityDocument->getReport();
        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals('rejected', $report->getStatus());
        $reasons = $report->getReasons();
        $this->assertIsArray($reasons);
        $this->assertCount(1, $reasons);

        $source = $verifaiResult->getSource();
        $this->assertInstanceOf(Source::class, $source);
        $this->assertInstanceOf(IdentifierUUID::class, $source->getIdentifierUuid());
        $this->assertEquals("3fa85f64-5717-4562-b3fc-2c963f66afa6", $source->getIdentifierUuid()->getValue());
        $this->assertEquals("WEB_SDK", $source->getInputApplication());
        $this->assertEquals("2.8.0", $source->getInputVersion());
        $this->assertEquals("Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36", $source->getUserAgent());

        // @TODO extract person test function
        $person = $verifaiResult->getPerson();
        $this->assertInstanceOf(Person::class, $person);
        $family = $person->getFamily();
        $this->assertInstanceOf(Family::class, $family);
        $this->assertEquals("John", $family->getFatherName());
        $this->assertEquals("Mary", $family->getMaidenName());
        $this->assertEquals("single", $family->getMaritalStatus());
        $this->assertEquals("Elizabeth", $family->getMotherName());
        $this->assertEquals("Joe", $family->getSpouseName());
        $personal = $person->getPersonal();
        $this->assertInstanceOf(Personal::class, $personal);
        $this->assertEquals("2022-04-13", $personal->getDateOfBirth()->format('Y-m-d'));
        $this->assertEquals("Willeke Liselotte", $personal->getGivenNames());
        $this->assertEquals(176, $personal->getHeight());
        $this->assertEquals("De Bruijn", $personal->getLastName());
        $this->assertEquals("NLD", $personal->getNationality());
        $this->assertEquals("999999990", $personal->getPersonalIdentityNumber());
        $this->assertEquals("Groningen", $personal->getPlaceOfBirth());
        $this->assertEquals("female", $personal->getSex());
        $personReport = $person->getReport();
        $this->assertInstanceOf(Report::class, $personReport);
        $this->assertCount(1, $personReport->getReasons());
        $this->assertEquals("consider_reason_person", $personReport->getReasons()[0]);
        $this->assertEquals("consider", $personReport->getStatus());
    }
}
