<?php

namespace Modules\Location\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class RegencySeederTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('regencies');

        \DB::table('regencies')->insert([
            0 => [
                'id' => '1101',
                'province_id' => '11',
                'name' => 'KABUPATEN SIMEULUE',
            ],
            1 => [
                'id' => '1102',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH SINGKIL',
            ],
            2 => [
                'id' => '1103',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH SELATAN',
            ],
            3 => [
                'id' => '1104',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH TENGGARA',
            ],
            4 => [
                'id' => '1105',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH TIMUR',
            ],
            5 => [
                'id' => '1106',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH TENGAH',
            ],
            6 => [
                'id' => '1107',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH BARAT',
            ],
            7 => [
                'id' => '1108',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH BESAR',
            ],
            8 => [
                'id' => '1109',
                'province_id' => '11',
                'name' => 'KABUPATEN PIDIE',
            ],
            9 => [
                'id' => '1110',
                'province_id' => '11',
                'name' => 'KABUPATEN BIREUEN',
            ],
            10 => [
                'id' => '1111',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH UTARA',
            ],
            11 => [
                'id' => '1112',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH BARAT DAYA',
            ],
            12 => [
                'id' => '1113',
                'province_id' => '11',
                'name' => 'KABUPATEN GAYO LUES',
            ],
            13 => [
                'id' => '1114',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH TAMIANG',
            ],
            14 => [
                'id' => '1115',
                'province_id' => '11',
                'name' => 'KABUPATEN NAGAN RAYA',
            ],
            15 => [
                'id' => '1116',
                'province_id' => '11',
                'name' => 'KABUPATEN ACEH JAYA',
            ],
            16 => [
                'id' => '1117',
                'province_id' => '11',
                'name' => 'KABUPATEN BENER MERIAH',
            ],
            17 => [
                'id' => '1118',
                'province_id' => '11',
                'name' => 'KABUPATEN PIDIE JAYA',
            ],
            18 => [
                'id' => '1171',
                'province_id' => '11',
                'name' => 'KOTA BANDA ACEH',
            ],
            19 => [
                'id' => '1172',
                'province_id' => '11',
                'name' => 'KOTA SABANG',
            ],
            20 => [
                'id' => '1173',
                'province_id' => '11',
                'name' => 'KOTA LANGSA',
            ],
            21 => [
                'id' => '1174',
                'province_id' => '11',
                'name' => 'KOTA LHOKSEUMAWE',
            ],
            22 => [
                'id' => '1175',
                'province_id' => '11',
                'name' => 'KOTA SUBULUSSALAM',
            ],
            23 => [
                'id' => '1201',
                'province_id' => '12',
                'name' => 'KABUPATEN NIAS',
            ],
            24 => [
                'id' => '1202',
                'province_id' => '12',
                'name' => 'KABUPATEN MANDAILING NATAL',
            ],
            25 => [
                'id' => '1203',
                'province_id' => '12',
                'name' => 'KABUPATEN TAPANULI SELATAN',
            ],
            26 => [
                'id' => '1204',
                'province_id' => '12',
                'name' => 'KABUPATEN TAPANULI TENGAH',
            ],
            27 => [
                'id' => '1205',
                'province_id' => '12',
                'name' => 'KABUPATEN TAPANULI UTARA',
            ],
            28 => [
                'id' => '1206',
                'province_id' => '12',
                'name' => 'KABUPATEN TOBA SAMOSIR',
            ],
            29 => [
                'id' => '1207',
                'province_id' => '12',
                'name' => 'KABUPATEN LABUHAN BATU',
            ],
            30 => [
                'id' => '1208',
                'province_id' => '12',
                'name' => 'KABUPATEN ASAHAN',
            ],
            31 => [
                'id' => '1209',
                'province_id' => '12',
                'name' => 'KABUPATEN SIMALUNGUN',
            ],
            32 => [
                'id' => '1210',
                'province_id' => '12',
                'name' => 'KABUPATEN DAIRI',
            ],
            33 => [
                'id' => '1211',
                'province_id' => '12',
                'name' => 'KABUPATEN KARO',
            ],
            34 => [
                'id' => '1212',
                'province_id' => '12',
                'name' => 'KABUPATEN DELI SERDANG',
            ],
            35 => [
                'id' => '1213',
                'province_id' => '12',
                'name' => 'KABUPATEN LANGKAT',
            ],
            36 => [
                'id' => '1214',
                'province_id' => '12',
                'name' => 'KABUPATEN NIAS SELATAN',
            ],
            37 => [
                'id' => '1215',
                'province_id' => '12',
                'name' => 'KABUPATEN HUMBANG HASUNDUTAN',
            ],
            38 => [
                'id' => '1216',
                'province_id' => '12',
                'name' => 'KABUPATEN PAKPAK BHARAT',
            ],
            39 => [
                'id' => '1217',
                'province_id' => '12',
                'name' => 'KABUPATEN SAMOSIR',
            ],
            40 => [
                'id' => '1218',
                'province_id' => '12',
                'name' => 'KABUPATEN SERDANG BEDAGAI',
            ],
            41 => [
                'id' => '1219',
                'province_id' => '12',
                'name' => 'KABUPATEN BATU BARA',
            ],
            42 => [
                'id' => '1220',
                'province_id' => '12',
                'name' => 'KABUPATEN PADANG LAWAS UTARA',
            ],
            43 => [
                'id' => '1221',
                'province_id' => '12',
                'name' => 'KABUPATEN PADANG LAWAS',
            ],
            44 => [
                'id' => '1222',
                'province_id' => '12',
                'name' => 'KABUPATEN LABUHAN BATU SELATAN',
            ],
            45 => [
                'id' => '1223',
                'province_id' => '12',
                'name' => 'KABUPATEN LABUHAN BATU UTARA',
            ],
            46 => [
                'id' => '1224',
                'province_id' => '12',
                'name' => 'KABUPATEN NIAS UTARA',
            ],
            47 => [
                'id' => '1225',
                'province_id' => '12',
                'name' => 'KABUPATEN NIAS BARAT',
            ],
            48 => [
                'id' => '1271',
                'province_id' => '12',
                'name' => 'KOTA SIBOLGA',
            ],
            49 => [
                'id' => '1272',
                'province_id' => '12',
                'name' => 'KOTA TANJUNG BALAI',
            ],
            50 => [
                'id' => '1273',
                'province_id' => '12',
                'name' => 'KOTA PEMATANG SIANTAR',
            ],
            51 => [
                'id' => '1274',
                'province_id' => '12',
                'name' => 'KOTA TEBING TINGGI',
            ],
            52 => [
                'id' => '1275',
                'province_id' => '12',
                'name' => 'KOTA MEDAN',
            ],
            53 => [
                'id' => '1276',
                'province_id' => '12',
                'name' => 'KOTA BINJAI',
            ],
            54 => [
                'id' => '1277',
                'province_id' => '12',
                'name' => 'KOTA PADANGSIDIMPUAN',
            ],
            55 => [
                'id' => '1278',
                'province_id' => '12',
                'name' => 'KOTA GUNUNGSITOLI',
            ],
            56 => [
                'id' => '1301',
                'province_id' => '13',
                'name' => 'KABUPATEN KEPULAUAN MENTAWAI',
            ],
            57 => [
                'id' => '1302',
                'province_id' => '13',
                'name' => 'KABUPATEN PESISIR SELATAN',
            ],
            58 => [
                'id' => '1303',
                'province_id' => '13',
                'name' => 'KABUPATEN SOLOK',
            ],
            59 => [
                'id' => '1304',
                'province_id' => '13',
                'name' => 'KABUPATEN SIJUNJUNG',
            ],
            60 => [
                'id' => '1305',
                'province_id' => '13',
                'name' => 'KABUPATEN TANAH DATAR',
            ],
            61 => [
                'id' => '1306',
                'province_id' => '13',
                'name' => 'KABUPATEN PADANG PARIAMAN',
            ],
            62 => [
                'id' => '1307',
                'province_id' => '13',
                'name' => 'KABUPATEN AGAM',
            ],
            63 => [
                'id' => '1308',
                'province_id' => '13',
                'name' => 'KABUPATEN LIMA PULUH KOTA',
            ],
            64 => [
                'id' => '1309',
                'province_id' => '13',
                'name' => 'KABUPATEN PASAMAN',
            ],
            65 => [
                'id' => '1310',
                'province_id' => '13',
                'name' => 'KABUPATEN SOLOK SELATAN',
            ],
            66 => [
                'id' => '1311',
                'province_id' => '13',
                'name' => 'KABUPATEN DHARMASRAYA',
            ],
            67 => [
                'id' => '1312',
                'province_id' => '13',
                'name' => 'KABUPATEN PASAMAN BARAT',
            ],
            68 => [
                'id' => '1371',
                'province_id' => '13',
                'name' => 'KOTA PADANG',
            ],
            69 => [
                'id' => '1372',
                'province_id' => '13',
                'name' => 'KOTA SOLOK',
            ],
            70 => [
                'id' => '1373',
                'province_id' => '13',
                'name' => 'KOTA SAWAH LUNTO',
            ],
            71 => [
                'id' => '1374',
                'province_id' => '13',
                'name' => 'KOTA PADANG PANJANG',
            ],
            72 => [
                'id' => '1375',
                'province_id' => '13',
                'name' => 'KOTA BUKITTINGGI',
            ],
            73 => [
                'id' => '1376',
                'province_id' => '13',
                'name' => 'KOTA PAYAKUMBUH',
            ],
            74 => [
                'id' => '1377',
                'province_id' => '13',
                'name' => 'KOTA PARIAMAN',
            ],
            75 => [
                'id' => '1401',
                'province_id' => '14',
                'name' => 'KABUPATEN KUANTAN SINGINGI',
            ],
            76 => [
                'id' => '1402',
                'province_id' => '14',
                'name' => 'KABUPATEN INDRAGIRI HULU',
            ],
            77 => [
                'id' => '1403',
                'province_id' => '14',
                'name' => 'KABUPATEN INDRAGIRI HILIR',
            ],
            78 => [
                'id' => '1404',
                'province_id' => '14',
                'name' => 'KABUPATEN PELALAWAN',
            ],
            79 => [
                'id' => '1405',
                'province_id' => '14',
                'name' => 'KABUPATEN S I A K',
            ],
            80 => [
                'id' => '1406',
                'province_id' => '14',
                'name' => 'KABUPATEN KAMPAR',
            ],
            81 => [
                'id' => '1407',
                'province_id' => '14',
                'name' => 'KABUPATEN ROKAN HULU',
            ],
            82 => [
                'id' => '1408',
                'province_id' => '14',
                'name' => 'KABUPATEN BENGKALIS',
            ],
            83 => [
                'id' => '1409',
                'province_id' => '14',
                'name' => 'KABUPATEN ROKAN HILIR',
            ],
            84 => [
                'id' => '1410',
                'province_id' => '14',
                'name' => 'KABUPATEN KEPULAUAN MERANTI',
            ],
            85 => [
                'id' => '1471',
                'province_id' => '14',
                'name' => 'KOTA PEKANBARU',
            ],
            86 => [
                'id' => '1473',
                'province_id' => '14',
                'name' => 'KOTA D U M A I',
            ],
            87 => [
                'id' => '1501',
                'province_id' => '15',
                'name' => 'KABUPATEN KERINCI',
            ],
            88 => [
                'id' => '1502',
                'province_id' => '15',
                'name' => 'KABUPATEN MERANGIN',
            ],
            89 => [
                'id' => '1503',
                'province_id' => '15',
                'name' => 'KABUPATEN SAROLANGUN',
            ],
            90 => [
                'id' => '1504',
                'province_id' => '15',
                'name' => 'KABUPATEN BATANG HARI',
            ],
            91 => [
                'id' => '1505',
                'province_id' => '15',
                'name' => 'KABUPATEN MUARO JAMBI',
            ],
            92 => [
                'id' => '1506',
                'province_id' => '15',
                'name' => 'KABUPATEN TANJUNG JABUNG TIMUR',
            ],
            93 => [
                'id' => '1507',
                'province_id' => '15',
                'name' => 'KABUPATEN TANJUNG JABUNG BARAT',
            ],
            94 => [
                'id' => '1508',
                'province_id' => '15',
                'name' => 'KABUPATEN TEBO',
            ],
            95 => [
                'id' => '1509',
                'province_id' => '15',
                'name' => 'KABUPATEN BUNGO',
            ],
            96 => [
                'id' => '1571',
                'province_id' => '15',
                'name' => 'KOTA JAMBI',
            ],
            97 => [
                'id' => '1572',
                'province_id' => '15',
                'name' => 'KOTA SUNGAI PENUH',
            ],
            98 => [
                'id' => '1601',
                'province_id' => '16',
                'name' => 'KABUPATEN OGAN KOMERING ULU',
            ],
            99 => [
                'id' => '1602',
                'province_id' => '16',
                'name' => 'KABUPATEN OGAN KOMERING ILIR',
            ],
            100 => [
                'id' => '1603',
                'province_id' => '16',
                'name' => 'KABUPATEN MUARA ENIM',
            ],
            101 => [
                'id' => '1604',
                'province_id' => '16',
                'name' => 'KABUPATEN LAHAT',
            ],
            102 => [
                'id' => '1605',
                'province_id' => '16',
                'name' => 'KABUPATEN MUSI RAWAS',
            ],
            103 => [
                'id' => '1606',
                'province_id' => '16',
                'name' => 'KABUPATEN MUSI BANYUASIN',
            ],
            104 => [
                'id' => '1607',
                'province_id' => '16',
                'name' => 'KABUPATEN BANYU ASIN',
            ],
            105 => [
                'id' => '1608',
                'province_id' => '16',
                'name' => 'KABUPATEN OGAN KOMERING ULU SELATAN',
            ],
            106 => [
                'id' => '1609',
                'province_id' => '16',
                'name' => 'KABUPATEN OGAN KOMERING ULU TIMUR',
            ],
            107 => [
                'id' => '1610',
                'province_id' => '16',
                'name' => 'KABUPATEN OGAN ILIR',
            ],
            108 => [
                'id' => '1611',
                'province_id' => '16',
                'name' => 'KABUPATEN EMPAT LAWANG',
            ],
            109 => [
                'id' => '1612',
                'province_id' => '16',
                'name' => 'KABUPATEN PENUKAL ABAB LEMATANG ILIR',
            ],
            110 => [
                'id' => '1613',
                'province_id' => '16',
                'name' => 'KABUPATEN MUSI RAWAS UTARA',
            ],
            111 => [
                'id' => '1671',
                'province_id' => '16',
                'name' => 'KOTA PALEMBANG',
            ],
            112 => [
                'id' => '1672',
                'province_id' => '16',
                'name' => 'KOTA PRABUMULIH',
            ],
            113 => [
                'id' => '1673',
                'province_id' => '16',
                'name' => 'KOTA PAGAR ALAM',
            ],
            114 => [
                'id' => '1674',
                'province_id' => '16',
                'name' => 'KOTA LUBUKLINGGAU',
            ],
            115 => [
                'id' => '1701',
                'province_id' => '17',
                'name' => 'KABUPATEN BENGKULU SELATAN',
            ],
            116 => [
                'id' => '1702',
                'province_id' => '17',
                'name' => 'KABUPATEN REJANG LEBONG',
            ],
            117 => [
                'id' => '1703',
                'province_id' => '17',
                'name' => 'KABUPATEN BENGKULU UTARA',
            ],
            118 => [
                'id' => '1704',
                'province_id' => '17',
                'name' => 'KABUPATEN KAUR',
            ],
            119 => [
                'id' => '1705',
                'province_id' => '17',
                'name' => 'KABUPATEN SELUMA',
            ],
            120 => [
                'id' => '1706',
                'province_id' => '17',
                'name' => 'KABUPATEN MUKOMUKO',
            ],
            121 => [
                'id' => '1707',
                'province_id' => '17',
                'name' => 'KABUPATEN LEBONG',
            ],
            122 => [
                'id' => '1708',
                'province_id' => '17',
                'name' => 'KABUPATEN KEPAHIANG',
            ],
            123 => [
                'id' => '1709',
                'province_id' => '17',
                'name' => 'KABUPATEN BENGKULU TENGAH',
            ],
            124 => [
                'id' => '1771',
                'province_id' => '17',
                'name' => 'KOTA BENGKULU',
            ],
            125 => [
                'id' => '1801',
                'province_id' => '18',
                'name' => 'KABUPATEN LAMPUNG BARAT',
            ],
            126 => [
                'id' => '1802',
                'province_id' => '18',
                'name' => 'KABUPATEN TANGGAMUS',
            ],
            127 => [
                'id' => '1803',
                'province_id' => '18',
                'name' => 'KABUPATEN LAMPUNG SELATAN',
            ],
            128 => [
                'id' => '1804',
                'province_id' => '18',
                'name' => 'KABUPATEN LAMPUNG TIMUR',
            ],
            129 => [
                'id' => '1805',
                'province_id' => '18',
                'name' => 'KABUPATEN LAMPUNG TENGAH',
            ],
            130 => [
                'id' => '1806',
                'province_id' => '18',
                'name' => 'KABUPATEN LAMPUNG UTARA',
            ],
            131 => [
                'id' => '1807',
                'province_id' => '18',
                'name' => 'KABUPATEN WAY KANAN',
            ],
            132 => [
                'id' => '1808',
                'province_id' => '18',
                'name' => 'KABUPATEN TULANGBAWANG',
            ],
            133 => [
                'id' => '1809',
                'province_id' => '18',
                'name' => 'KABUPATEN PESAWARAN',
            ],
            134 => [
                'id' => '1810',
                'province_id' => '18',
                'name' => 'KABUPATEN PRINGSEWU',
            ],
            135 => [
                'id' => '1811',
                'province_id' => '18',
                'name' => 'KABUPATEN MESUJI',
            ],
            136 => [
                'id' => '1812',
                'province_id' => '18',
                'name' => 'KABUPATEN TULANG BAWANG BARAT',
            ],
            137 => [
                'id' => '1813',
                'province_id' => '18',
                'name' => 'KABUPATEN PESISIR BARAT',
            ],
            138 => [
                'id' => '1871',
                'province_id' => '18',
                'name' => 'KOTA BANDAR LAMPUNG',
            ],
            139 => [
                'id' => '1872',
                'province_id' => '18',
                'name' => 'KOTA METRO',
            ],
            140 => [
                'id' => '1901',
                'province_id' => '19',
                'name' => 'KABUPATEN BANGKA',
            ],
            141 => [
                'id' => '1902',
                'province_id' => '19',
                'name' => 'KABUPATEN BELITUNG',
            ],
            142 => [
                'id' => '1903',
                'province_id' => '19',
                'name' => 'KABUPATEN BANGKA BARAT',
            ],
            143 => [
                'id' => '1904',
                'province_id' => '19',
                'name' => 'KABUPATEN BANGKA TENGAH',
            ],
            144 => [
                'id' => '1905',
                'province_id' => '19',
                'name' => 'KABUPATEN BANGKA SELATAN',
            ],
            145 => [
                'id' => '1906',
                'province_id' => '19',
                'name' => 'KABUPATEN BELITUNG TIMUR',
            ],
            146 => [
                'id' => '1971',
                'province_id' => '19',
                'name' => 'KOTA PANGKAL PINANG',
            ],
            147 => [
                'id' => '2101',
                'province_id' => '21',
                'name' => 'KABUPATEN KARIMUN',
            ],
            148 => [
                'id' => '2102',
                'province_id' => '21',
                'name' => 'KABUPATEN BINTAN',
            ],
            149 => [
                'id' => '2103',
                'province_id' => '21',
                'name' => 'KABUPATEN NATUNA',
            ],
            150 => [
                'id' => '2104',
                'province_id' => '21',
                'name' => 'KABUPATEN LINGGA',
            ],
            151 => [
                'id' => '2105',
                'province_id' => '21',
                'name' => 'KABUPATEN KEPULAUAN ANAMBAS',
            ],
            152 => [
                'id' => '2171',
                'province_id' => '21',
                'name' => 'KOTA B A T A M',
            ],
            153 => [
                'id' => '2172',
                'province_id' => '21',
                'name' => 'KOTA TANJUNG PINANG',
            ],
            154 => [
                'id' => '3101',
                'province_id' => '31',
                'name' => 'KABUPATEN KEPULAUAN SERIBU',
            ],
            155 => [
                'id' => '3171',
                'province_id' => '31',
                'name' => 'KOTA JAKARTA SELATAN',
            ],
            156 => [
                'id' => '3172',
                'province_id' => '31',
                'name' => 'KOTA JAKARTA TIMUR',
            ],
            157 => [
                'id' => '3173',
                'province_id' => '31',
                'name' => 'KOTA JAKARTA PUSAT',
            ],
            158 => [
                'id' => '3174',
                'province_id' => '31',
                'name' => 'KOTA JAKARTA BARAT',
            ],
            159 => [
                'id' => '3175',
                'province_id' => '31',
                'name' => 'KOTA JAKARTA UTARA',
            ],
            160 => [
                'id' => '3201',
                'province_id' => '32',
                'name' => 'KABUPATEN BOGOR',
            ],
            161 => [
                'id' => '3202',
                'province_id' => '32',
                'name' => 'KABUPATEN SUKABUMI',
            ],
            162 => [
                'id' => '3203',
                'province_id' => '32',
                'name' => 'KABUPATEN CIANJUR',
            ],
            163 => [
                'id' => '3204',
                'province_id' => '32',
                'name' => 'KABUPATEN BANDUNG',
            ],
            164 => [
                'id' => '3205',
                'province_id' => '32',
                'name' => 'KABUPATEN GARUT',
            ],
            165 => [
                'id' => '3206',
                'province_id' => '32',
                'name' => 'KABUPATEN TASIKMALAYA',
            ],
            166 => [
                'id' => '3207',
                'province_id' => '32',
                'name' => 'KABUPATEN CIAMIS',
            ],
            167 => [
                'id' => '3208',
                'province_id' => '32',
                'name' => 'KABUPATEN KUNINGAN',
            ],
            168 => [
                'id' => '3209',
                'province_id' => '32',
                'name' => 'KABUPATEN CIREBON',
            ],
            169 => [
                'id' => '3210',
                'province_id' => '32',
                'name' => 'KABUPATEN MAJALENGKA',
            ],
            170 => [
                'id' => '3211',
                'province_id' => '32',
                'name' => 'KABUPATEN SUMEDANG',
            ],
            171 => [
                'id' => '3212',
                'province_id' => '32',
                'name' => 'KABUPATEN INDRAMAYU',
            ],
            172 => [
                'id' => '3213',
                'province_id' => '32',
                'name' => 'KABUPATEN SUBANG',
            ],
            173 => [
                'id' => '3214',
                'province_id' => '32',
                'name' => 'KABUPATEN PURWAKARTA',
            ],
            174 => [
                'id' => '3215',
                'province_id' => '32',
                'name' => 'KABUPATEN KARAWANG',
            ],
            175 => [
                'id' => '3216',
                'province_id' => '32',
                'name' => 'KABUPATEN BEKASI',
            ],
            176 => [
                'id' => '3217',
                'province_id' => '32',
                'name' => 'KABUPATEN BANDUNG BARAT',
            ],
            177 => [
                'id' => '3218',
                'province_id' => '32',
                'name' => 'KABUPATEN PANGANDARAN',
            ],
            178 => [
                'id' => '3271',
                'province_id' => '32',
                'name' => 'KOTA BOGOR',
            ],
            179 => [
                'id' => '3272',
                'province_id' => '32',
                'name' => 'KOTA SUKABUMI',
            ],
            180 => [
                'id' => '3273',
                'province_id' => '32',
                'name' => 'KOTA BANDUNG',
            ],
            181 => [
                'id' => '3274',
                'province_id' => '32',
                'name' => 'KOTA CIREBON',
            ],
            182 => [
                'id' => '3275',
                'province_id' => '32',
                'name' => 'KOTA BEKASI',
            ],
            183 => [
                'id' => '3276',
                'province_id' => '32',
                'name' => 'KOTA DEPOK',
            ],
            184 => [
                'id' => '3277',
                'province_id' => '32',
                'name' => 'KOTA CIMAHI',
            ],
            185 => [
                'id' => '3278',
                'province_id' => '32',
                'name' => 'KOTA TASIKMALAYA',
            ],
            186 => [
                'id' => '3279',
                'province_id' => '32',
                'name' => 'KOTA BANJAR',
            ],
            187 => [
                'id' => '3301',
                'province_id' => '33',
                'name' => 'KABUPATEN CILACAP',
            ],
            188 => [
                'id' => '3302',
                'province_id' => '33',
                'name' => 'KABUPATEN BANYUMAS',
            ],
            189 => [
                'id' => '3303',
                'province_id' => '33',
                'name' => 'KABUPATEN PURBALINGGA',
            ],
            190 => [
                'id' => '3304',
                'province_id' => '33',
                'name' => 'KABUPATEN BANJARNEGARA',
            ],
            191 => [
                'id' => '3305',
                'province_id' => '33',
                'name' => 'KABUPATEN KEBUMEN',
            ],
            192 => [
                'id' => '3306',
                'province_id' => '33',
                'name' => 'KABUPATEN PURWOREJO',
            ],
            193 => [
                'id' => '3307',
                'province_id' => '33',
                'name' => 'KABUPATEN WONOSOBO',
            ],
            194 => [
                'id' => '3308',
                'province_id' => '33',
                'name' => 'KABUPATEN MAGELANG',
            ],
            195 => [
                'id' => '3309',
                'province_id' => '33',
                'name' => 'KABUPATEN BOYOLALI',
            ],
            196 => [
                'id' => '3310',
                'province_id' => '33',
                'name' => 'KABUPATEN KLATEN',
            ],
            197 => [
                'id' => '3311',
                'province_id' => '33',
                'name' => 'KABUPATEN SUKOHARJO',
            ],
            198 => [
                'id' => '3312',
                'province_id' => '33',
                'name' => 'KABUPATEN WONOGIRI',
            ],
            199 => [
                'id' => '3313',
                'province_id' => '33',
                'name' => 'KABUPATEN KARANGANYAR',
            ],
            200 => [
                'id' => '3314',
                'province_id' => '33',
                'name' => 'KABUPATEN SRAGEN',
            ],
            201 => [
                'id' => '3315',
                'province_id' => '33',
                'name' => 'KABUPATEN GROBOGAN',
            ],
            202 => [
                'id' => '3316',
                'province_id' => '33',
                'name' => 'KABUPATEN BLORA',
            ],
            203 => [
                'id' => '3317',
                'province_id' => '33',
                'name' => 'KABUPATEN REMBANG',
            ],
            204 => [
                'id' => '3318',
                'province_id' => '33',
                'name' => 'KABUPATEN PATI',
            ],
            205 => [
                'id' => '3319',
                'province_id' => '33',
                'name' => 'KABUPATEN KUDUS',
            ],
            206 => [
                'id' => '3320',
                'province_id' => '33',
                'name' => 'KABUPATEN JEPARA',
            ],
            207 => [
                'id' => '3321',
                'province_id' => '33',
                'name' => 'KABUPATEN DEMAK',
            ],
            208 => [
                'id' => '3322',
                'province_id' => '33',
                'name' => 'KABUPATEN SEMARANG',
            ],
            209 => [
                'id' => '3323',
                'province_id' => '33',
                'name' => 'KABUPATEN TEMANGGUNG',
            ],
            210 => [
                'id' => '3324',
                'province_id' => '33',
                'name' => 'KABUPATEN KENDAL',
            ],
            211 => [
                'id' => '3325',
                'province_id' => '33',
                'name' => 'KABUPATEN BATANG',
            ],
            212 => [
                'id' => '3326',
                'province_id' => '33',
                'name' => 'KABUPATEN PEKALONGAN',
            ],
            213 => [
                'id' => '3327',
                'province_id' => '33',
                'name' => 'KABUPATEN PEMALANG',
            ],
            214 => [
                'id' => '3328',
                'province_id' => '33',
                'name' => 'KABUPATEN TEGAL',
            ],
            215 => [
                'id' => '3329',
                'province_id' => '33',
                'name' => 'KABUPATEN BREBES',
            ],
            216 => [
                'id' => '3371',
                'province_id' => '33',
                'name' => 'KOTA MAGELANG',
            ],
            217 => [
                'id' => '3372',
                'province_id' => '33',
                'name' => 'KOTA SURAKARTA',
            ],
            218 => [
                'id' => '3373',
                'province_id' => '33',
                'name' => 'KOTA SALATIGA',
            ],
            219 => [
                'id' => '3374',
                'province_id' => '33',
                'name' => 'KOTA SEMARANG',
            ],
            220 => [
                'id' => '3375',
                'province_id' => '33',
                'name' => 'KOTA PEKALONGAN',
            ],
            221 => [
                'id' => '3376',
                'province_id' => '33',
                'name' => 'KOTA TEGAL',
            ],
            222 => [
                'id' => '3401',
                'province_id' => '34',
                'name' => 'KABUPATEN KULON PROGO',
            ],
            223 => [
                'id' => '3402',
                'province_id' => '34',
                'name' => 'KABUPATEN BANTUL',
            ],
            224 => [
                'id' => '3403',
                'province_id' => '34',
                'name' => 'KABUPATEN GUNUNG KIDUL',
            ],
            225 => [
                'id' => '3404',
                'province_id' => '34',
                'name' => 'KABUPATEN SLEMAN',
            ],
            226 => [
                'id' => '3471',
                'province_id' => '34',
                'name' => 'KOTA YOGYAKARTA',
            ],
            227 => [
                'id' => '3501',
                'province_id' => '35',
                'name' => 'KABUPATEN PACITAN',
            ],
            228 => [
                'id' => '3502',
                'province_id' => '35',
                'name' => 'KABUPATEN PONOROGO',
            ],
            229 => [
                'id' => '3503',
                'province_id' => '35',
                'name' => 'KABUPATEN TRENGGALEK',
            ],
            230 => [
                'id' => '3504',
                'province_id' => '35',
                'name' => 'KABUPATEN TULUNGAGUNG',
            ],
            231 => [
                'id' => '3505',
                'province_id' => '35',
                'name' => 'KABUPATEN BLITAR',
            ],
            232 => [
                'id' => '3506',
                'province_id' => '35',
                'name' => 'KABUPATEN KEDIRI',
            ],
            233 => [
                'id' => '3507',
                'province_id' => '35',
                'name' => 'KABUPATEN MALANG',
            ],
            234 => [
                'id' => '3508',
                'province_id' => '35',
                'name' => 'KABUPATEN LUMAJANG',
            ],
            235 => [
                'id' => '3509',
                'province_id' => '35',
                'name' => 'KABUPATEN JEMBER',
            ],
            236 => [
                'id' => '3510',
                'province_id' => '35',
                'name' => 'KABUPATEN BANYUWANGI',
            ],
            237 => [
                'id' => '3511',
                'province_id' => '35',
                'name' => 'KABUPATEN BONDOWOSO',
            ],
            238 => [
                'id' => '3512',
                'province_id' => '35',
                'name' => 'KABUPATEN SITUBONDO',
            ],
            239 => [
                'id' => '3513',
                'province_id' => '35',
                'name' => 'KABUPATEN PROBOLINGGO',
            ],
            240 => [
                'id' => '3514',
                'province_id' => '35',
                'name' => 'KABUPATEN PASURUAN',
            ],
            241 => [
                'id' => '3515',
                'province_id' => '35',
                'name' => 'KABUPATEN SIDOARJO',
            ],
            242 => [
                'id' => '3516',
                'province_id' => '35',
                'name' => 'KABUPATEN MOJOKERTO',
            ],
            243 => [
                'id' => '3517',
                'province_id' => '35',
                'name' => 'KABUPATEN JOMBANG',
            ],
            244 => [
                'id' => '3518',
                'province_id' => '35',
                'name' => 'KABUPATEN NGANJUK',
            ],
            245 => [
                'id' => '3519',
                'province_id' => '35',
                'name' => 'KABUPATEN MADIUN',
            ],
            246 => [
                'id' => '3520',
                'province_id' => '35',
                'name' => 'KABUPATEN MAGETAN',
            ],
            247 => [
                'id' => '3521',
                'province_id' => '35',
                'name' => 'KABUPATEN NGAWI',
            ],
            248 => [
                'id' => '3522',
                'province_id' => '35',
                'name' => 'KABUPATEN BOJONEGORO',
            ],
            249 => [
                'id' => '3523',
                'province_id' => '35',
                'name' => 'KABUPATEN TUBAN',
            ],
            250 => [
                'id' => '3524',
                'province_id' => '35',
                'name' => 'KABUPATEN LAMONGAN',
            ],
            251 => [
                'id' => '3525',
                'province_id' => '35',
                'name' => 'KABUPATEN GRESIK',
            ],
            252 => [
                'id' => '3526',
                'province_id' => '35',
                'name' => 'KABUPATEN BANGKALAN',
            ],
            253 => [
                'id' => '3527',
                'province_id' => '35',
                'name' => 'KABUPATEN SAMPANG',
            ],
            254 => [
                'id' => '3528',
                'province_id' => '35',
                'name' => 'KABUPATEN PAMEKASAN',
            ],
            255 => [
                'id' => '3529',
                'province_id' => '35',
                'name' => 'KABUPATEN SUMENEP',
            ],
            256 => [
                'id' => '3571',
                'province_id' => '35',
                'name' => 'KOTA KEDIRI',
            ],
            257 => [
                'id' => '3572',
                'province_id' => '35',
                'name' => 'KOTA BLITAR',
            ],
            258 => [
                'id' => '3573',
                'province_id' => '35',
                'name' => 'KOTA MALANG',
            ],
            259 => [
                'id' => '3574',
                'province_id' => '35',
                'name' => 'KOTA PROBOLINGGO',
            ],
            260 => [
                'id' => '3575',
                'province_id' => '35',
                'name' => 'KOTA PASURUAN',
            ],
            261 => [
                'id' => '3576',
                'province_id' => '35',
                'name' => 'KOTA MOJOKERTO',
            ],
            262 => [
                'id' => '3577',
                'province_id' => '35',
                'name' => 'KOTA MADIUN',
            ],
            263 => [
                'id' => '3578',
                'province_id' => '35',
                'name' => 'KOTA SURABAYA',
            ],
            264 => [
                'id' => '3579',
                'province_id' => '35',
                'name' => 'KOTA BATU',
            ],
            265 => [
                'id' => '3601',
                'province_id' => '36',
                'name' => 'KABUPATEN PANDEGLANG',
            ],
            266 => [
                'id' => '3602',
                'province_id' => '36',
                'name' => 'KABUPATEN LEBAK',
            ],
            267 => [
                'id' => '3603',
                'province_id' => '36',
                'name' => 'KABUPATEN TANGERANG',
            ],
            268 => [
                'id' => '3604',
                'province_id' => '36',
                'name' => 'KABUPATEN SERANG',
            ],
            269 => [
                'id' => '3671',
                'province_id' => '36',
                'name' => 'KOTA TANGERANG',
            ],
            270 => [
                'id' => '3672',
                'province_id' => '36',
                'name' => 'KOTA CILEGON',
            ],
            271 => [
                'id' => '3673',
                'province_id' => '36',
                'name' => 'KOTA SERANG',
            ],
            272 => [
                'id' => '3674',
                'province_id' => '36',
                'name' => 'KOTA TANGERANG SELATAN',
            ],
            273 => [
                'id' => '5101',
                'province_id' => '51',
                'name' => 'KABUPATEN JEMBRANA',
            ],
            274 => [
                'id' => '5102',
                'province_id' => '51',
                'name' => 'KABUPATEN TABANAN',
            ],
            275 => [
                'id' => '5103',
                'province_id' => '51',
                'name' => 'KABUPATEN BADUNG',
            ],
            276 => [
                'id' => '5104',
                'province_id' => '51',
                'name' => 'KABUPATEN GIANYAR',
            ],
            277 => [
                'id' => '5105',
                'province_id' => '51',
                'name' => 'KABUPATEN KLUNGKUNG',
            ],
            278 => [
                'id' => '5106',
                'province_id' => '51',
                'name' => 'KABUPATEN BANGLI',
            ],
            279 => [
                'id' => '5107',
                'province_id' => '51',
                'name' => 'KABUPATEN KARANG ASEM',
            ],
            280 => [
                'id' => '5108',
                'province_id' => '51',
                'name' => 'KABUPATEN BULELENG',
            ],
            281 => [
                'id' => '5171',
                'province_id' => '51',
                'name' => 'KOTA DENPASAR',
            ],
            282 => [
                'id' => '5201',
                'province_id' => '52',
                'name' => 'KABUPATEN LOMBOK BARAT',
            ],
            283 => [
                'id' => '5202',
                'province_id' => '52',
                'name' => 'KABUPATEN LOMBOK TENGAH',
            ],
            284 => [
                'id' => '5203',
                'province_id' => '52',
                'name' => 'KABUPATEN LOMBOK TIMUR',
            ],
            285 => [
                'id' => '5204',
                'province_id' => '52',
                'name' => 'KABUPATEN SUMBAWA',
            ],
            286 => [
                'id' => '5205',
                'province_id' => '52',
                'name' => 'KABUPATEN DOMPU',
            ],
            287 => [
                'id' => '5206',
                'province_id' => '52',
                'name' => 'KABUPATEN BIMA',
            ],
            288 => [
                'id' => '5207',
                'province_id' => '52',
                'name' => 'KABUPATEN SUMBAWA BARAT',
            ],
            289 => [
                'id' => '5208',
                'province_id' => '52',
                'name' => 'KABUPATEN LOMBOK UTARA',
            ],
            290 => [
                'id' => '5271',
                'province_id' => '52',
                'name' => 'KOTA MATARAM',
            ],
            291 => [
                'id' => '5272',
                'province_id' => '52',
                'name' => 'KOTA BIMA',
            ],
            292 => [
                'id' => '5301',
                'province_id' => '53',
                'name' => 'KABUPATEN SUMBA BARAT',
            ],
            293 => [
                'id' => '5302',
                'province_id' => '53',
                'name' => 'KABUPATEN SUMBA TIMUR',
            ],
            294 => [
                'id' => '5303',
                'province_id' => '53',
                'name' => 'KABUPATEN KUPANG',
            ],
            295 => [
                'id' => '5304',
                'province_id' => '53',
                'name' => 'KABUPATEN TIMOR TENGAH SELATAN',
            ],
            296 => [
                'id' => '5305',
                'province_id' => '53',
                'name' => 'KABUPATEN TIMOR TENGAH UTARA',
            ],
            297 => [
                'id' => '5306',
                'province_id' => '53',
                'name' => 'KABUPATEN BELU',
            ],
            298 => [
                'id' => '5307',
                'province_id' => '53',
                'name' => 'KABUPATEN ALOR',
            ],
            299 => [
                'id' => '5308',
                'province_id' => '53',
                'name' => 'KABUPATEN LEMBATA',
            ],
            300 => [
                'id' => '5309',
                'province_id' => '53',
                'name' => 'KABUPATEN FLORES TIMUR',
            ],
            301 => [
                'id' => '5310',
                'province_id' => '53',
                'name' => 'KABUPATEN SIKKA',
            ],
            302 => [
                'id' => '5311',
                'province_id' => '53',
                'name' => 'KABUPATEN ENDE',
            ],
            303 => [
                'id' => '5312',
                'province_id' => '53',
                'name' => 'KABUPATEN NGADA',
            ],
            304 => [
                'id' => '5313',
                'province_id' => '53',
                'name' => 'KABUPATEN MANGGARAI',
            ],
            305 => [
                'id' => '5314',
                'province_id' => '53',
                'name' => 'KABUPATEN ROTE NDAO',
            ],
            306 => [
                'id' => '5315',
                'province_id' => '53',
                'name' => 'KABUPATEN MANGGARAI BARAT',
            ],
            307 => [
                'id' => '5316',
                'province_id' => '53',
                'name' => 'KABUPATEN SUMBA TENGAH',
            ],
            308 => [
                'id' => '5317',
                'province_id' => '53',
                'name' => 'KABUPATEN SUMBA BARAT DAYA',
            ],
            309 => [
                'id' => '5318',
                'province_id' => '53',
                'name' => 'KABUPATEN NAGEKEO',
            ],
            310 => [
                'id' => '5319',
                'province_id' => '53',
                'name' => 'KABUPATEN MANGGARAI TIMUR',
            ],
            311 => [
                'id' => '5320',
                'province_id' => '53',
                'name' => 'KABUPATEN SABU RAIJUA',
            ],
            312 => [
                'id' => '5321',
                'province_id' => '53',
                'name' => 'KABUPATEN MALAKA',
            ],
            313 => [
                'id' => '5371',
                'province_id' => '53',
                'name' => 'KOTA KUPANG',
            ],
            314 => [
                'id' => '6101',
                'province_id' => '61',
                'name' => 'KABUPATEN SAMBAS',
            ],
            315 => [
                'id' => '6102',
                'province_id' => '61',
                'name' => 'KABUPATEN BENGKAYANG',
            ],
            316 => [
                'id' => '6103',
                'province_id' => '61',
                'name' => 'KABUPATEN LANDAK',
            ],
            317 => [
                'id' => '6104',
                'province_id' => '61',
                'name' => 'KABUPATEN MEMPAWAH',
            ],
            318 => [
                'id' => '6105',
                'province_id' => '61',
                'name' => 'KABUPATEN SANGGAU',
            ],
            319 => [
                'id' => '6106',
                'province_id' => '61',
                'name' => 'KABUPATEN KETAPANG',
            ],
            320 => [
                'id' => '6107',
                'province_id' => '61',
                'name' => 'KABUPATEN SINTANG',
            ],
            321 => [
                'id' => '6108',
                'province_id' => '61',
                'name' => 'KABUPATEN KAPUAS HULU',
            ],
            322 => [
                'id' => '6109',
                'province_id' => '61',
                'name' => 'KABUPATEN SEKADAU',
            ],
            323 => [
                'id' => '6110',
                'province_id' => '61',
                'name' => 'KABUPATEN MELAWI',
            ],
            324 => [
                'id' => '6111',
                'province_id' => '61',
                'name' => 'KABUPATEN KAYONG UTARA',
            ],
            325 => [
                'id' => '6112',
                'province_id' => '61',
                'name' => 'KABUPATEN KUBU RAYA',
            ],
            326 => [
                'id' => '6171',
                'province_id' => '61',
                'name' => 'KOTA PONTIANAK',
            ],
            327 => [
                'id' => '6172',
                'province_id' => '61',
                'name' => 'KOTA SINGKAWANG',
            ],
            328 => [
                'id' => '6201',
                'province_id' => '62',
                'name' => 'KABUPATEN KOTAWARINGIN BARAT',
            ],
            329 => [
                'id' => '6202',
                'province_id' => '62',
                'name' => 'KABUPATEN KOTAWARINGIN TIMUR',
            ],
            330 => [
                'id' => '6203',
                'province_id' => '62',
                'name' => 'KABUPATEN KAPUAS',
            ],
            331 => [
                'id' => '6204',
                'province_id' => '62',
                'name' => 'KABUPATEN BARITO SELATAN',
            ],
            332 => [
                'id' => '6205',
                'province_id' => '62',
                'name' => 'KABUPATEN BARITO UTARA',
            ],
            333 => [
                'id' => '6206',
                'province_id' => '62',
                'name' => 'KABUPATEN SUKAMARA',
            ],
            334 => [
                'id' => '6207',
                'province_id' => '62',
                'name' => 'KABUPATEN LAMANDAU',
            ],
            335 => [
                'id' => '6208',
                'province_id' => '62',
                'name' => 'KABUPATEN SERUYAN',
            ],
            336 => [
                'id' => '6209',
                'province_id' => '62',
                'name' => 'KABUPATEN KATINGAN',
            ],
            337 => [
                'id' => '6210',
                'province_id' => '62',
                'name' => 'KABUPATEN PULANG PISAU',
            ],
            338 => [
                'id' => '6211',
                'province_id' => '62',
                'name' => 'KABUPATEN GUNUNG MAS',
            ],
            339 => [
                'id' => '6212',
                'province_id' => '62',
                'name' => 'KABUPATEN BARITO TIMUR',
            ],
            340 => [
                'id' => '6213',
                'province_id' => '62',
                'name' => 'KABUPATEN MURUNG RAYA',
            ],
            341 => [
                'id' => '6271',
                'province_id' => '62',
                'name' => 'KOTA PALANGKA RAYA',
            ],
            342 => [
                'id' => '6301',
                'province_id' => '63',
                'name' => 'KABUPATEN TANAH LAUT',
            ],
            343 => [
                'id' => '6302',
                'province_id' => '63',
                'name' => 'KABUPATEN KOTA BARU',
            ],
            344 => [
                'id' => '6303',
                'province_id' => '63',
                'name' => 'KABUPATEN BANJAR',
            ],
            345 => [
                'id' => '6304',
                'province_id' => '63',
                'name' => 'KABUPATEN BARITO KUALA',
            ],
            346 => [
                'id' => '6305',
                'province_id' => '63',
                'name' => 'KABUPATEN TAPIN',
            ],
            347 => [
                'id' => '6306',
                'province_id' => '63',
                'name' => 'KABUPATEN HULU SUNGAI SELATAN',
            ],
            348 => [
                'id' => '6307',
                'province_id' => '63',
                'name' => 'KABUPATEN HULU SUNGAI TENGAH',
            ],
            349 => [
                'id' => '6308',
                'province_id' => '63',
                'name' => 'KABUPATEN HULU SUNGAI UTARA',
            ],
            350 => [
                'id' => '6309',
                'province_id' => '63',
                'name' => 'KABUPATEN TABALONG',
            ],
            351 => [
                'id' => '6310',
                'province_id' => '63',
                'name' => 'KABUPATEN TANAH BUMBU',
            ],
            352 => [
                'id' => '6311',
                'province_id' => '63',
                'name' => 'KABUPATEN BALANGAN',
            ],
            353 => [
                'id' => '6371',
                'province_id' => '63',
                'name' => 'KOTA BANJARMASIN',
            ],
            354 => [
                'id' => '6372',
                'province_id' => '63',
                'name' => 'KOTA BANJAR BARU',
            ],
            355 => [
                'id' => '6401',
                'province_id' => '64',
                'name' => 'KABUPATEN PASER',
            ],
            356 => [
                'id' => '6402',
                'province_id' => '64',
                'name' => 'KABUPATEN KUTAI BARAT',
            ],
            357 => [
                'id' => '6403',
                'province_id' => '64',
                'name' => 'KABUPATEN KUTAI KARTANEGARA',
            ],
            358 => [
                'id' => '6404',
                'province_id' => '64',
                'name' => 'KABUPATEN KUTAI TIMUR',
            ],
            359 => [
                'id' => '6405',
                'province_id' => '64',
                'name' => 'KABUPATEN BERAU',
            ],
            360 => [
                'id' => '6409',
                'province_id' => '64',
                'name' => 'KABUPATEN PENAJAM PASER UTARA',
            ],
            361 => [
                'id' => '6411',
                'province_id' => '64',
                'name' => 'KABUPATEN MAHAKAM HULU',
            ],
            362 => [
                'id' => '6471',
                'province_id' => '64',
                'name' => 'KOTA BALIKPAPAN',
            ],
            363 => [
                'id' => '6472',
                'province_id' => '64',
                'name' => 'KOTA SAMARINDA',
            ],
            364 => [
                'id' => '6474',
                'province_id' => '64',
                'name' => 'KOTA BONTANG',
            ],
            365 => [
                'id' => '6501',
                'province_id' => '65',
                'name' => 'KABUPATEN MALINAU',
            ],
            366 => [
                'id' => '6502',
                'province_id' => '65',
                'name' => 'KABUPATEN BULUNGAN',
            ],
            367 => [
                'id' => '6503',
                'province_id' => '65',
                'name' => 'KABUPATEN TANA TIDUNG',
            ],
            368 => [
                'id' => '6504',
                'province_id' => '65',
                'name' => 'KABUPATEN NUNUKAN',
            ],
            369 => [
                'id' => '6571',
                'province_id' => '65',
                'name' => 'KOTA TARAKAN',
            ],
            370 => [
                'id' => '7101',
                'province_id' => '71',
                'name' => 'KABUPATEN BOLAANG MONGONDOW',
            ],
            371 => [
                'id' => '7102',
                'province_id' => '71',
                'name' => 'KABUPATEN MINAHASA',
            ],
            372 => [
                'id' => '7103',
                'province_id' => '71',
                'name' => 'KABUPATEN KEPULAUAN SANGIHE',
            ],
            373 => [
                'id' => '7104',
                'province_id' => '71',
                'name' => 'KABUPATEN KEPULAUAN TALAUD',
            ],
            374 => [
                'id' => '7105',
                'province_id' => '71',
                'name' => 'KABUPATEN MINAHASA SELATAN',
            ],
            375 => [
                'id' => '7106',
                'province_id' => '71',
                'name' => 'KABUPATEN MINAHASA UTARA',
            ],
            376 => [
                'id' => '7107',
                'province_id' => '71',
                'name' => 'KABUPATEN BOLAANG MONGONDOW UTARA',
            ],
            377 => [
                'id' => '7108',
                'province_id' => '71',
                'name' => 'KABUPATEN SIAU TAGULANDANG BIARO',
            ],
            378 => [
                'id' => '7109',
                'province_id' => '71',
                'name' => 'KABUPATEN MINAHASA TENGGARA',
            ],
            379 => [
                'id' => '7110',
                'province_id' => '71',
                'name' => 'KABUPATEN BOLAANG MONGONDOW SELATAN',
            ],
            380 => [
                'id' => '7111',
                'province_id' => '71',
                'name' => 'KABUPATEN BOLAANG MONGONDOW TIMUR',
            ],
            381 => [
                'id' => '7171',
                'province_id' => '71',
                'name' => 'KOTA MANADO',
            ],
            382 => [
                'id' => '7172',
                'province_id' => '71',
                'name' => 'KOTA BITUNG',
            ],
            383 => [
                'id' => '7173',
                'province_id' => '71',
                'name' => 'KOTA TOMOHON',
            ],
            384 => [
                'id' => '7174',
                'province_id' => '71',
                'name' => 'KOTA KOTAMOBAGU',
            ],
            385 => [
                'id' => '7201',
                'province_id' => '72',
                'name' => 'KABUPATEN BANGGAI KEPULAUAN',
            ],
            386 => [
                'id' => '7202',
                'province_id' => '72',
                'name' => 'KABUPATEN BANGGAI',
            ],
            387 => [
                'id' => '7203',
                'province_id' => '72',
                'name' => 'KABUPATEN MOROWALI',
            ],
            388 => [
                'id' => '7204',
                'province_id' => '72',
                'name' => 'KABUPATEN POSO',
            ],
            389 => [
                'id' => '7205',
                'province_id' => '72',
                'name' => 'KABUPATEN DONGGALA',
            ],
            390 => [
                'id' => '7206',
                'province_id' => '72',
                'name' => 'KABUPATEN TOLI-TOLI',
            ],
            391 => [
                'id' => '7207',
                'province_id' => '72',
                'name' => 'KABUPATEN BUOL',
            ],
            392 => [
                'id' => '7208',
                'province_id' => '72',
                'name' => 'KABUPATEN PARIGI MOUTONG',
            ],
            393 => [
                'id' => '7209',
                'province_id' => '72',
                'name' => 'KABUPATEN TOJO UNA-UNA',
            ],
            394 => [
                'id' => '7210',
                'province_id' => '72',
                'name' => 'KABUPATEN SIGI',
            ],
            395 => [
                'id' => '7211',
                'province_id' => '72',
                'name' => 'KABUPATEN BANGGAI LAUT',
            ],
            396 => [
                'id' => '7212',
                'province_id' => '72',
                'name' => 'KABUPATEN MOROWALI UTARA',
            ],
            397 => [
                'id' => '7271',
                'province_id' => '72',
                'name' => 'KOTA PALU',
            ],
            398 => [
                'id' => '7301',
                'province_id' => '73',
                'name' => 'KABUPATEN KEPULAUAN SELAYAR',
            ],
            399 => [
                'id' => '7302',
                'province_id' => '73',
                'name' => 'KABUPATEN BULUKUMBA',
            ],
            400 => [
                'id' => '7303',
                'province_id' => '73',
                'name' => 'KABUPATEN BANTAENG',
            ],
            401 => [
                'id' => '7304',
                'province_id' => '73',
                'name' => 'KABUPATEN JENEPONTO',
            ],
            402 => [
                'id' => '7305',
                'province_id' => '73',
                'name' => 'KABUPATEN TAKALAR',
            ],
            403 => [
                'id' => '7306',
                'province_id' => '73',
                'name' => 'KABUPATEN GOWA',
            ],
            404 => [
                'id' => '7307',
                'province_id' => '73',
                'name' => 'KABUPATEN SINJAI',
            ],
            405 => [
                'id' => '7308',
                'province_id' => '73',
                'name' => 'KABUPATEN MAROS',
            ],
            406 => [
                'id' => '7309',
                'province_id' => '73',
                'name' => 'KABUPATEN PANGKAJENE DAN KEPULAUAN',
            ],
            407 => [
                'id' => '7310',
                'province_id' => '73',
                'name' => 'KABUPATEN BARRU',
            ],
            408 => [
                'id' => '7311',
                'province_id' => '73',
                'name' => 'KABUPATEN BONE',
            ],
            409 => [
                'id' => '7312',
                'province_id' => '73',
                'name' => 'KABUPATEN SOPPENG',
            ],
            410 => [
                'id' => '7313',
                'province_id' => '73',
                'name' => 'KABUPATEN WAJO',
            ],
            411 => [
                'id' => '7314',
                'province_id' => '73',
                'name' => 'KABUPATEN SIDENRENG RAPPANG',
            ],
            412 => [
                'id' => '7315',
                'province_id' => '73',
                'name' => 'KABUPATEN PINRANG',
            ],
            413 => [
                'id' => '7316',
                'province_id' => '73',
                'name' => 'KABUPATEN ENREKANG',
            ],
            414 => [
                'id' => '7317',
                'province_id' => '73',
                'name' => 'KABUPATEN LUWU',
            ],
            415 => [
                'id' => '7318',
                'province_id' => '73',
                'name' => 'KABUPATEN TANA TORAJA',
            ],
            416 => [
                'id' => '7322',
                'province_id' => '73',
                'name' => 'KABUPATEN LUWU UTARA',
            ],
            417 => [
                'id' => '7325',
                'province_id' => '73',
                'name' => 'KABUPATEN LUWU TIMUR',
            ],
            418 => [
                'id' => '7326',
                'province_id' => '73',
                'name' => 'KABUPATEN TORAJA UTARA',
            ],
            419 => [
                'id' => '7371',
                'province_id' => '73',
                'name' => 'KOTA MAKASSAR',
            ],
            420 => [
                'id' => '7372',
                'province_id' => '73',
                'name' => 'KOTA PAREPARE',
            ],
            421 => [
                'id' => '7373',
                'province_id' => '73',
                'name' => 'KOTA PALOPO',
            ],
            422 => [
                'id' => '7401',
                'province_id' => '74',
                'name' => 'KABUPATEN BUTON',
            ],
            423 => [
                'id' => '7402',
                'province_id' => '74',
                'name' => 'KABUPATEN MUNA',
            ],
            424 => [
                'id' => '7403',
                'province_id' => '74',
                'name' => 'KABUPATEN KONAWE',
            ],
            425 => [
                'id' => '7404',
                'province_id' => '74',
                'name' => 'KABUPATEN KOLAKA',
            ],
            426 => [
                'id' => '7405',
                'province_id' => '74',
                'name' => 'KABUPATEN KONAWE SELATAN',
            ],
            427 => [
                'id' => '7406',
                'province_id' => '74',
                'name' => 'KABUPATEN BOMBANA',
            ],
            428 => [
                'id' => '7407',
                'province_id' => '74',
                'name' => 'KABUPATEN WAKATOBI',
            ],
            429 => [
                'id' => '7408',
                'province_id' => '74',
                'name' => 'KABUPATEN KOLAKA UTARA',
            ],
            430 => [
                'id' => '7409',
                'province_id' => '74',
                'name' => 'KABUPATEN BUTON UTARA',
            ],
            431 => [
                'id' => '7410',
                'province_id' => '74',
                'name' => 'KABUPATEN KONAWE UTARA',
            ],
            432 => [
                'id' => '7411',
                'province_id' => '74',
                'name' => 'KABUPATEN KOLAKA TIMUR',
            ],
            433 => [
                'id' => '7412',
                'province_id' => '74',
                'name' => 'KABUPATEN KONAWE KEPULAUAN',
            ],
            434 => [
                'id' => '7413',
                'province_id' => '74',
                'name' => 'KABUPATEN MUNA BARAT',
            ],
            435 => [
                'id' => '7414',
                'province_id' => '74',
                'name' => 'KABUPATEN BUTON TENGAH',
            ],
            436 => [
                'id' => '7415',
                'province_id' => '74',
                'name' => 'KABUPATEN BUTON SELATAN',
            ],
            437 => [
                'id' => '7471',
                'province_id' => '74',
                'name' => 'KOTA KENDARI',
            ],
            438 => [
                'id' => '7472',
                'province_id' => '74',
                'name' => 'KOTA BAUBAU',
            ],
            439 => [
                'id' => '7501',
                'province_id' => '75',
                'name' => 'KABUPATEN BOALEMO',
            ],
            440 => [
                'id' => '7502',
                'province_id' => '75',
                'name' => 'KABUPATEN GORONTALO',
            ],
            441 => [
                'id' => '7503',
                'province_id' => '75',
                'name' => 'KABUPATEN POHUWATO',
            ],
            442 => [
                'id' => '7504',
                'province_id' => '75',
                'name' => 'KABUPATEN BONE BOLANGO',
            ],
            443 => [
                'id' => '7505',
                'province_id' => '75',
                'name' => 'KABUPATEN GORONTALO UTARA',
            ],
            444 => [
                'id' => '7571',
                'province_id' => '75',
                'name' => 'KOTA GORONTALO',
            ],
            445 => [
                'id' => '7601',
                'province_id' => '76',
                'name' => 'KABUPATEN MAJENE',
            ],
            446 => [
                'id' => '7602',
                'province_id' => '76',
                'name' => 'KABUPATEN POLEWALI MANDAR',
            ],
            447 => [
                'id' => '7603',
                'province_id' => '76',
                'name' => 'KABUPATEN MAMASA',
            ],
            448 => [
                'id' => '7604',
                'province_id' => '76',
                'name' => 'KABUPATEN MAMUJU',
            ],
            449 => [
                'id' => '7605',
                'province_id' => '76',
                'name' => 'KABUPATEN MAMUJU UTARA',
            ],
            450 => [
                'id' => '7606',
                'province_id' => '76',
                'name' => 'KABUPATEN MAMUJU TENGAH',
            ],
            451 => [
                'id' => '8101',
                'province_id' => '81',
                'name' => 'KABUPATEN MALUKU TENGGARA BARAT',
            ],
            452 => [
                'id' => '8102',
                'province_id' => '81',
                'name' => 'KABUPATEN MALUKU TENGGARA',
            ],
            453 => [
                'id' => '8103',
                'province_id' => '81',
                'name' => 'KABUPATEN MALUKU TENGAH',
            ],
            454 => [
                'id' => '8104',
                'province_id' => '81',
                'name' => 'KABUPATEN BURU',
            ],
            455 => [
                'id' => '8105',
                'province_id' => '81',
                'name' => 'KABUPATEN KEPULAUAN ARU',
            ],
            456 => [
                'id' => '8106',
                'province_id' => '81',
                'name' => 'KABUPATEN SERAM BAGIAN BARAT',
            ],
            457 => [
                'id' => '8107',
                'province_id' => '81',
                'name' => 'KABUPATEN SERAM BAGIAN TIMUR',
            ],
            458 => [
                'id' => '8108',
                'province_id' => '81',
                'name' => 'KABUPATEN MALUKU BARAT DAYA',
            ],
            459 => [
                'id' => '8109',
                'province_id' => '81',
                'name' => 'KABUPATEN BURU SELATAN',
            ],
            460 => [
                'id' => '8171',
                'province_id' => '81',
                'name' => 'KOTA AMBON',
            ],
            461 => [
                'id' => '8172',
                'province_id' => '81',
                'name' => 'KOTA TUAL',
            ],
            462 => [
                'id' => '8201',
                'province_id' => '82',
                'name' => 'KABUPATEN HALMAHERA BARAT',
            ],
            463 => [
                'id' => '8202',
                'province_id' => '82',
                'name' => 'KABUPATEN HALMAHERA TENGAH',
            ],
            464 => [
                'id' => '8203',
                'province_id' => '82',
                'name' => 'KABUPATEN KEPULAUAN SULA',
            ],
            465 => [
                'id' => '8204',
                'province_id' => '82',
                'name' => 'KABUPATEN HALMAHERA SELATAN',
            ],
            466 => [
                'id' => '8205',
                'province_id' => '82',
                'name' => 'KABUPATEN HALMAHERA UTARA',
            ],
            467 => [
                'id' => '8206',
                'province_id' => '82',
                'name' => 'KABUPATEN HALMAHERA TIMUR',
            ],
            468 => [
                'id' => '8207',
                'province_id' => '82',
                'name' => 'KABUPATEN PULAU MOROTAI',
            ],
            469 => [
                'id' => '8208',
                'province_id' => '82',
                'name' => 'KABUPATEN PULAU TALIABU',
            ],
            470 => [
                'id' => '8271',
                'province_id' => '82',
                'name' => 'KOTA TERNATE',
            ],
            471 => [
                'id' => '8272',
                'province_id' => '82',
                'name' => 'KOTA TIDORE KEPULAUAN',
            ],
            472 => [
                'id' => '9101',
                'province_id' => '91',
                'name' => 'KABUPATEN FAKFAK',
            ],
            473 => [
                'id' => '9102',
                'province_id' => '91',
                'name' => 'KABUPATEN KAIMANA',
            ],
            474 => [
                'id' => '9103',
                'province_id' => '91',
                'name' => 'KABUPATEN TELUK WONDAMA',
            ],
            475 => [
                'id' => '9104',
                'province_id' => '91',
                'name' => 'KABUPATEN TELUK BINTUNI',
            ],
            476 => [
                'id' => '9105',
                'province_id' => '91',
                'name' => 'KABUPATEN MANOKWARI',
            ],
            477 => [
                'id' => '9106',
                'province_id' => '91',
                'name' => 'KABUPATEN SORONG SELATAN',
            ],
            478 => [
                'id' => '9107',
                'province_id' => '91',
                'name' => 'KABUPATEN SORONG',
            ],
            479 => [
                'id' => '9108',
                'province_id' => '91',
                'name' => 'KABUPATEN RAJA AMPAT',
            ],
            480 => [
                'id' => '9109',
                'province_id' => '91',
                'name' => 'KABUPATEN TAMBRAUW',
            ],
            481 => [
                'id' => '9110',
                'province_id' => '91',
                'name' => 'KABUPATEN MAYBRAT',
            ],
            482 => [
                'id' => '9111',
                'province_id' => '91',
                'name' => 'KABUPATEN MANOKWARI SELATAN',
            ],
            483 => [
                'id' => '9112',
                'province_id' => '91',
                'name' => 'KABUPATEN PEGUNUNGAN ARFAK',
            ],
            484 => [
                'id' => '9171',
                'province_id' => '91',
                'name' => 'KOTA SORONG',
            ],
            485 => [
                'id' => '9401',
                'province_id' => '94',
                'name' => 'KABUPATEN MERAUKE',
            ],
            486 => [
                'id' => '9402',
                'province_id' => '94',
                'name' => 'KABUPATEN JAYAWIJAYA',
            ],
            487 => [
                'id' => '9403',
                'province_id' => '94',
                'name' => 'KABUPATEN JAYAPURA',
            ],
            488 => [
                'id' => '9404',
                'province_id' => '94',
                'name' => 'KABUPATEN NABIRE',
            ],
            489 => [
                'id' => '9408',
                'province_id' => '94',
                'name' => 'KABUPATEN KEPULAUAN YAPEN',
            ],
            490 => [
                'id' => '9409',
                'province_id' => '94',
                'name' => 'KABUPATEN BIAK NUMFOR',
            ],
            491 => [
                'id' => '9410',
                'province_id' => '94',
                'name' => 'KABUPATEN PANIAI',
            ],
            492 => [
                'id' => '9411',
                'province_id' => '94',
                'name' => 'KABUPATEN PUNCAK JAYA',
            ],
            493 => [
                'id' => '9412',
                'province_id' => '94',
                'name' => 'KABUPATEN MIMIKA',
            ],
            494 => [
                'id' => '9413',
                'province_id' => '94',
                'name' => 'KABUPATEN BOVEN DIGOEL',
            ],
            495 => [
                'id' => '9414',
                'province_id' => '94',
                'name' => 'KABUPATEN MAPPI',
            ],
            496 => [
                'id' => '9415',
                'province_id' => '94',
                'name' => 'KABUPATEN ASMAT',
            ],
            497 => [
                'id' => '9416',
                'province_id' => '94',
                'name' => 'KABUPATEN YAHUKIMO',
            ],
            498 => [
                'id' => '9417',
                'province_id' => '94',
                'name' => 'KABUPATEN PEGUNUNGAN BINTANG',
            ],
            499 => [
                'id' => '9418',
                'province_id' => '94',
                'name' => 'KABUPATEN TOLIKARA',
            ],
        ]);
        \DB::table('regencies')->insert([
            0 => [
                'id' => '9419',
                'province_id' => '94',
                'name' => 'KABUPATEN SARMI',
            ],
            1 => [
                'id' => '9420',
                'province_id' => '94',
                'name' => 'KABUPATEN KEEROM',
            ],
            2 => [
                'id' => '9426',
                'province_id' => '94',
                'name' => 'KABUPATEN WAROPEN',
            ],
            3 => [
                'id' => '9427',
                'province_id' => '94',
                'name' => 'KABUPATEN SUPIORI',
            ],
            4 => [
                'id' => '9428',
                'province_id' => '94',
                'name' => 'KABUPATEN MAMBERAMO RAYA',
            ],
            5 => [
                'id' => '9429',
                'province_id' => '94',
                'name' => 'KABUPATEN NDUGA',
            ],
            6 => [
                'id' => '9430',
                'province_id' => '94',
                'name' => 'KABUPATEN LANNY JAYA',
            ],
            7 => [
                'id' => '9431',
                'province_id' => '94',
                'name' => 'KABUPATEN MAMBERAMO TENGAH',
            ],
            8 => [
                'id' => '9432',
                'province_id' => '94',
                'name' => 'KABUPATEN YALIMO',
            ],
            9 => [
                'id' => '9433',
                'province_id' => '94',
                'name' => 'KABUPATEN PUNCAK',
            ],
            10 => [
                'id' => '9434',
                'province_id' => '94',
                'name' => 'KABUPATEN DOGIYAI',
            ],
            11 => [
                'id' => '9435',
                'province_id' => '94',
                'name' => 'KABUPATEN INTAN JAYA',
            ],
            12 => [
                'id' => '9436',
                'province_id' => '94',
                'name' => 'KABUPATEN DEIYAI',
            ],
            13 => [
                'id' => '9471',
                'province_id' => '94',
                'name' => 'KOTA JAYAPURA',
            ],
        ]);

        $this->enableForeignKeys();
    }
}
