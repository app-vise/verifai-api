<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class MRZFactory extends AbstractFactory
{
    public static function fromArray(array $data): MRZ
    {
        return new MRZ(
            self::pluckInteger('composite_check_digit', $data),
            self::pluckString('country_code', $data),
            self::pluckString('country_code_parsed', $data),
            self::pluckString('date_of_birth', $data),
            self::pluckDate('date_of_birth_parsed', $data, '!Y-m-d'),
            self::pluckInteger('date_of_birth_check_digit', $data),
            self::pluckString('date_of_expiry', $data),
            self::pluckDate('date_of_expiry_parsed', $data, 'Y-m-d'),
            self::pluckInteger('date_of_expiry_check_digit', $data),
            self::pluckString('document_number', $data),
            self::pluckInteger('document_number_check_digit', $data),
            self::pluckString('document_sub_type', $data),
            self::pluckString('document_type', $data),
            self::pluckString('format', $data),
            self::pluckString('given_names', $data),
            self::pluckBoolean('is_composite_valid', $data),
            self::pluckBoolean('is_date_of_birth_valid', $data),
            self::pluckBoolean('is_date_of_expiry_valid', $data),
            self::pluckBoolean('is_date_of_issue_valid', $data),
            self::pluckBoolean('is_document_code_valid', $data),
            self::pluckBoolean('is_document_number_valid', $data),
            self::pluckBoolean('is_line1_length_valid', $data),
            self::pluckBoolean('is_line2_length_valid', $data),
            self::pluckBoolean('is_line3_length_valid', $data),
            self::pluckBoolean('is_nfc_key_valid', $data),
            self::pluckBoolean('is_optional_data_valid', $data),
            self::escape(self::pluckString('mrz_string', $data)),
            self::pluckString('nationality', $data),
            self::pluckString('nationality_parsed', $data),
            self::pluckString('nfc_key', $data),
            self::pluckString('optional_data', $data),
            self::pluckInteger('optional_data_check_digit', $data),
            self::pluckString('optional_data_two', $data),
            self::pluckString('sex', $data),
            self::pluckString('surname', $data),
        );
    }

}
