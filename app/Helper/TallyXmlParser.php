<?php

namespace App\Helper;

class TallyXmlParser
{
    public static function parseVouchers(string $xml)
    {
        $simpleXml = simplexml_load_string($xml);
        if (!$simpleXml) {
            return [];
        }

        $vouchers = [];

        foreach ($simpleXml->xpath('//VOUCHER') as $voucher) {
            $vouchers[] = [
                'voucher_guid' => (string) $voucher->GUID,
                'alter_id'     => (int) $voucher->ALTERID,
                'voucher_type' => (string) $voucher->VOUCHERTYPENAME,
                'voucher_no'   => (string) $voucher->VOUCHERNUMBER,
                'voucher_date' => self::formatDate((string) $voucher->DATE),
                'party_name'   => (string) $voucher->PARTYLEDGERNAME,
                'amount'       => (float) $voucher->AMOUNT,
            ];
        }

        return $vouchers;
    }

    private static function formatDate($date)
    {
        return \Carbon\Carbon::createFromFormat('Ymd', $date)->toDateString();
    }
}
