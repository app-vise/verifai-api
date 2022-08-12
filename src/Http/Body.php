<?php

declare(strict_types=1);

namespace Appvise\Verifai\Http;

use Exception;

class Body
{
    private const LOCALES = [
        "en_US",
        "en_GB",
        "de_DE",
        "nl_NL",
        "pt_PT",
        "bg_BG",
        "cs_CZ",
        "da_DK",
        "es_ES",
        "fi_FI",
        "fr_FR",
        "el_GR",
        "hr_HR",
        "ko_KR",
        "no_NO",
        "pl_PL",
        "ro_RO",
        "sv_SE",
        "tr_TR",
        "ar_SA",
        "it_IT",
    ];
    /** @var string[] $document_type_whitelist */
    private $document_type_whitelist = ["P", "I", "D", "RP", "R"];
    /** @var string[] $country_choices_whitelist */
    private $country_choices_whitelist = [];
    /** @var string[] $country_choices_blacklist */
    private $country_choices_blacklist = [];
    /** @var string $handover_base_url */
    private $handover_base_url;
    /** @var bool $allow_edit_privacy_filters */
    private $allow_edit_privacy_filters = false;
    /** @var string $locale */
    private $locale = 'en_US';
    /** @var string $cors_allowed_origin */
    private $cors_allowed_origin = '*';
    /** @var bool $enable_viz */
    private $enable_viz = false;
    /** @var bool $enable_facematch */
    private $enable_facematch = false;
    /** @var string[] $validators */
    private $validators = [];

    public function __construct(string $handover_base_url)
    {
        if (!filter_var($handover_base_url, FILTER_VALIDATE_URL)) {
            throw new Exception('Handover base url must be a valid URL. Please provide one.');
        }
        $this->handover_base_url = $handover_base_url;
    }

    public function addDocuments(array $documentTypes)
    {
        $this->document_type_whitelist = $documentTypes;
    }

    public function whitelistCountry(string $country)
    {
        if (!in_array($country, $this->country_choices_whitelist)) {
            array_push($this->country_choices_whitelist, $country);
        }
    }

    public function blacklistCountry(string $country)
    {
        if (!in_array($country, $this->country_choices_blacklist)) {
            array_push($this->country_choices_blacklist, $country);
        }
    }

    public function setLocale(string $locale)
    {
        if (!in_array($locale, self::LOCALES)) {
            throw new Exception("Locale is not supported");
        }
        $this->locale = $locale;
    }

    public function enableViz()
    {
        $this->enable_viz = true;
    }

    public function enableFacematch()
    {
        $this->enable_facematch = true;
    }

    public function allowEditPrivacyFilters()
    {
        $this->allow_edit_privacy_filters = true;
    }

    public function setCors(string $cors)
    {
        if (!filter_var($cors, FILTER_VALIDATE_URL)) {
            throw new Exception('Cors must be a valid URL');
        }
        $this->cors_allowed_origin = $cors;
    }

    public function addValidator($validator)
    {
        if (!in_array($validator, $this->validators)) {
            array_push($this->validators, $validator);
        }
    }

    public function toArray(): array
    {
        return [
            'handover_base_url' => $this->handover_base_url,
            'document_type_whitelist' => array_values($this->document_type_whitelist),
            'country_choices_whitelist' => array_values($this->country_choices_whitelist),
            'country_choices_blacklist' => array_values($this->country_choices_blacklist),
            'locale' => $this->locale,
            'enable_viz' => $this->enable_viz,
            'enable_facematch' => $this->enable_facematch,
            'allow_edit_privacy_filters' => $this->allow_edit_privacy_filters,
            'cors_allowed_origin' => $this->cors_allowed_origin,
            'validators' => $this->validators,
        ];
    }
}
