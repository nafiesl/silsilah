<?php

return [

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi standar pesan kesalahan yang digunakan oleh
    | kelas validasi. Beberapa aturan mempunyai multi versi seperti aturan 'size'.
    | Jangan ragu untuk mengoptimalkan setiap pesan yang ada di sini.
    |
    */

    "accepted"             => "Isian :attribute harus diterima.",
    "active_url"           => "Isian :attribute bukan URL yang valid.",
    "after"                => "Isian :attribute harus tanggal setelah :date.",
    'after_or_equal'       => 'Isian :attribute harus tanggal setelah atau sama dengan :date.',
    "alpha"                => "Isian :attribute hanya boleh berisi huruf.",
    "alpha_dash"           => "Isian :attribute hanya boleh berisi huruf, angka, dan strip.",
    "alpha_num"            => "Isian :attribute hanya boleh berisi huruf dan angka.",
    "array"                => "Isian :attribute harus berupa sebuah array.",
    "before"               => "Isian :attribute harus tanggal sebelum :date.",
    'before_or_equal'      => 'Isian :attribute harus tanggal sebelum atau sama dengan :date.',
    "between"              => [
        "numeric" => "Isian :attribute harus antara :min dan :max.",
        "file"    => "Isian :attribute harus antara :min dan :max kilobytes.",
        "string"  => "Isian :attribute harus antara :min dan :max karakter.",
        "array"   => "Isian :attribute harus antara :min dan :max item.",
    ],
    "boolean"              => "Isian :attribute harus berupa true atau false",
    "confirmed"            => "Konfirmasi :attribute tidak cocok.",
    "date"                 => "Isian :attribute bukan tanggal yang valid.",
    "date_format"          => "Isian :attribute tidak cocok dengan format :format.",
    "different"            => "Isian :attribute dan :other harus berbeda.",
    "digits"               => "Isian :attribute harus berupa angka :digits.",
    "digits_between"       => "Isian :attribute harus antara angka :min dan :max.",
    'dimensions'           => 'Dimensi gambar :attribute tidak valid.',
    'distinct'             => 'Isian :attribute terduplikat.',
    "email"                => "Isian :attribute harus berupa alamat surel yang valid.",
    "exists"               => "Isian :attribute yang dipilih tidak valid.",
    'file'                 => 'Isian :attribute harus berupa file.',
    "filled"               => "Bidang isian :attribute wajib diisi.",
    "image"                => "Isian :attribute harus berupa gambar.",
    "in"                   => "Isian :attribute yang dipilih tidak valid.",
    'in_array'             => 'Isian :attribute tidak terdapat pada :other.',
    "integer"              => "Isian :attribute harus merupakan bilangan bulat.",
    "ip"                   => "Isian :attribute harus berupa alamat IP yang valid.",
    'ipv4'                 => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    "max"                  => [
        "numeric" => "Isian :attribute seharusnya tidak lebih dari :max.",
        "file"    => "Isian :attribute seharusnya tidak lebih dari :max kilobytes.",
        "string"  => "Isian :attribute seharusnya tidak lebih dari :max karakter.",
        "array"   => "Isian :attribute seharusnya tidak lebih dari :max item.",
    ],
    "mimes"                => "Isian :attribute harus dokumen berjenis : :values.",
    'mimetypes'            => 'Isian :attribute harus dokumen berjenis : :values.',
    "min"                  => [
        "numeric" => "Isian :attribute harus minimal :min.",
        "file"    => "Isian :attribute harus minimal :min kilobytes.",
        "string"  => "Isian :attribute harus minimal :min karakter.",
        "array"   => "Isian :attribute harus minimal :min item.",
    ],
    "not_in"               => "Isian :attribute yang dipilih tidak valid.",
    "numeric"              => "Isian :attribute harus berupa angka.",
    'present'              => 'Isian :attribute harus ada.',
    "regex"                => "Format isian :attribute tidak valid.",
    "required"             => "Wajib diisi.",
    "required_if"          => "Bidang isian :attribute wajib diisi bila :other adalah :value.",
    'required_unless'      => 'Bidang isian :attribute wajib diisi kecuali :other berisi :values.',
    "required_with"        => "Bidang isian :attribute wajib diisi bila terdapat :values.",
    "required_with_all"    => "Bidang isian :attribute wajib diisi bila terdapat :values.",
    "required_without"     => "Bidang isian :attribute wajib diisi bila tidak terdapat :values.",
    "required_without_all" => "Bidang isian :attribute wajib diisi bila tidak terdapat ada :values.",
    "same"                 => "Isian :attribute dan :other harus sama.",
    "size"                 => [
        "numeric" => "Isian :attribute harus berukuran :size.",
        "file"    => "Isian :attribute harus berukuran :size kilobyte.",
        "string"  => "Isian :attribute harus berukuran :size karakter.",
        "array"   => "Isian :attribute harus mengandung :size item.",
    ],
    "string"               => "Isian :attribute harus berupa string.",
    "timezone"             => "Isian :attribute harus berupa zona waktu yang valid.",
    "unique"               => "Isian :attribute sudah ada sebelumnya.",
    'uploaded'             => 'Isian :attribute gagan diupload.',
    "url"                  => "Format isian :attribute tidak valid.",

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi Kustom
    |---------------------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan menggunakan
    | konvensi "attribute.rule" dalam penamaan baris. Hal ini membuat cepat dalam
    | menentukan spesifik baris bahasa kustom untuk aturan atribut yang diberikan.
    |
    */

    'user' => [
        'replacement_user_id' => [
            'required' => 'Wajib dipilih.',
        ],
    ],

    /*
    |---------------------------------------------------------------------------------------
    | Kustom Validasi Atribut
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar atribut 'place-holders'
    | dengan sesuatu yang lebih bersahabat dengan pembaca seperti Alamat Surel daripada
    | "surel" saja. Ini benar-benar membantu kita membuat pesan sedikit bersih.
    |
    */

    'attributes' => [],

];
