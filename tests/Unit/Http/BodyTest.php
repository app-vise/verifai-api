<?php

declare(strict_types=1);

namespace Appvise\Verifai\Test\Unit\Http;

use Appvise\Verifai\Http\Body;
use Exception;
use PHPUnit\Framework\TestCase;

class BodyTest extends TestCase
{
    private const VALID_URL = 'https://www.validurl.com';

    /** @test */
    public function a_valid_handover_url_is_required(): void
    {
        $body = new Body(self::VALID_URL);
        $this->assertEquals('https://www.validurl.com', $body->toArray()['handover_base_url']);
    }

    /** @test */
    public function default_locale_is_en_us(): void
    {
        $body = new Body(self::VALID_URL);
        $this->assertEquals('en_US', $body->toArray()['locale']);
    }

    /** @test */
    public function set_locale(): void
    {
        $body = new Body(self::VALID_URL);
        $body->setLocale('nl_NL');
        $this->assertEquals('nl_NL', $body->toArray()['locale']);
    }

    /** @test */
    public function locale_must_be_a_valid_iso_language_code_and_iso_country_code(): void
    {
        $this->expectException(Exception::class);
        $body = new Body(self::VALID_URL);
        $body->setLocale('INVALID_country');
    }

    /** @test */
    public function viz_is_disabled_by_default(): void
    {
        $body = new Body(self::VALID_URL);
        $this->assertFalse($body->toArray()['enable_viz']);
    }

    /** @test */
    public function enable_viz(): void
    {
        $body = new Body(self::VALID_URL);
        $body->enableViz();
        $this->assertTrue($body->toArray()['enable_viz']);
    }

    /** @test */
    public function face_match_is_disabled_by_default(): void
    {
        $body = new Body(self::VALID_URL);
        $this->assertFalse($body->toArray()['enable_facematch']);
    }

    /** @test */
    public function enable_face_match(): void
    {
        $body = new Body(self::VALID_URL);
        $body->enableFacematch();
        $this->assertTrue($body->toArray()['enable_facematch']);
    }

    /** @test */
    public function allow_edit_privacy_filters_is_false_by_default(): void
    {
        $body = new Body(self::VALID_URL);
        $this->assertFalse($body->toArray()['allow_edit_privacy_filters']);
    }

    /** @test */
    public function enabling_edit_privacy_filters(): void
    {
        $body = new Body(self::VALID_URL);
        $body->allowEditPrivacyFilters();
        $this->assertTrue($body->toArray()['allow_edit_privacy_filters']);
    }

    /** @test */
    public function any_origin_is_allowed_by_default(): void
    {
        $body = new Body(self::VALID_URL);
        $this->assertEquals('*', $body->toArray()['cors_allowed_origin']);
    }

    /** @test */
    public function invalid_cors_domain_throws_exception(): void
    {
        $this->expectException(Exception::class);
        $body = new Body(self::VALID_URL);
        $body->setCors('NOT_A_VALID_DOMAIN');
    }

    /** @test */
    public function setting_valid_cors_allowed_origin(): void
    {
        $body = new Body(self::VALID_URL);
        $body->setCors('https://validdomain.com');
        $this->assertEquals('https://validdomain.com', $body->toArray()['cors_allowed_origin']);
    }

    /** @test */
    public function an_invalid_handover_url_throws_exception(): void
    {
        $this->expectException(Exception::class);
        new Body('INVALID_URL');
    }

    /** @test */
    public function default_all_documents_are_whitelisted(): void
    {
        $body = new Body(self::VALID_URL);
        $this->assertCount(5, $body->toArray()['document_type_whitelist']);
    }

    /** @test */
    public function adding_multiple_document_white_lists_at_once(): void
    {
        $body = new Body(self::VALID_URL);
        $body->addDocuments([
            'P',
            'I',
            'D',
            'RP',
        ]);
        $this->assertCount(4, $body->toArray()['document_type_whitelist']);
    }

    /** @test */
    public function cannot_add_the_same_country_to_white_list(): void
    {
        $body = new Body(self::VALID_URL);
        $body->whitelistCountry('NL');
        $body->whitelistCountry('NL');
        $this->assertCount(1, $body->toArray()['country_choices_whitelist']);
    }

    /** @test */
    public function cannot_add_the_same_country_to_black_list(): void
    {
        $body = new Body(self::VALID_URL);
        $body->blacklistCountry('NL');
        $body->blacklistCountry('NL');
        $this->assertCount(1, $body->toArray()['country_choices_blacklist']);
    }

    /** @test */
    public function cannot_add_the_same_validator(): void
    {
        $body = new Body(self::VALID_URL);
        $body->addValidator('VALIDATOR');
        $body->addValidator('VALIDATOR');
        $this->assertCount(1, $body->toArray()['validators']);
    }
}
