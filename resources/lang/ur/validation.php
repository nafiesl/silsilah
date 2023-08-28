<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute کو قبول کرنا ضروری ہے۔',
    'active_url'           => ':attribute درست URL نہیں ہے۔',
    'after'                => ':attribute کا تاریخ :date سے بعد کی ہونی ضروری ہے۔',
    'after_or_equal'       => ':attribute کا تاریخ :date سے بعد یا اس کے برابر ہونی ضروری ہے۔',
    'alpha'                => ':attribute صرف حروف تہجی کے حروف شامل کر سکتا ہے۔',
    'alpha_dash'           => ':attribute صرف حروف تہجی، اعداد، خطوط اور زیر خطیں شامل کر سکتا ہے۔',
    'alpha_num'            => ':attribute صرف حروف تہجی اور اعداد شامل کر سکتا ہے۔',
    'array'                => ':attribute ایک اریے ہونا ضروری ہے۔',
    'before'               => ':attribute کا تاریخ :date سے پہلے ہونی ضروری ہے۔',
    'before_or_equal'      => ':attribute کا تاریخ :date سے پہلے یا اس کے برابر ہونی ضروری ہے۔',
    'between'              => [
        'numeric' => ':attribute کا مقدار :min اور :max کے درمیان ہونا ضروری ہے۔',
        'file'    => ':attribute کا سائز :min اور :max کلوبائٹ کے درمیان ہونا ضروری ہے۔',
        'string'  => ':attribute کی لمبائی :min اور :max حروف کے درمیان ہونی ضروری ہے۔',
        'array'   => ':attribute میں :min اور :max آئٹمز کے درمیان ہونا ضروری ہے۔',
    ],
    'boolean'              => ':attribute کا فیلڈ صحیح یا غلط ہونا ضروری ہے۔',
    'confirmed'            => ':attribute کی تصدیق مماثل نہیں ہے۔',
    'date'                 => ':attribute درست تاریخ نہیں ہے۔',
    'date_format'          => ':attribute کا فارمیٹ :format سے مماثل نہیں ہے۔',
    'different'            => ':attribute اور :other مختلف ہونا ضروری ہے۔',
    'digits'               => ':attribute کا مقدار :digits ہونا ضروری ہے۔',
    'digits_between'       => ':attribute کا مقدار :min اور :max کے درمیان ہونا ضروری ہے۔',
    'dimensions'           => ':attribute کی غلط تصویر کے ابعاد ہیں۔',
    'distinct'             => ':attribute کا فیلڈ تکراری قیمت رکھتا ہے۔',
    'email'                => ':attribute درست ای میل نہیں ہے۔',
    'exists'               => 'منتخب کردہ :attribute غلط ہے۔',
    'file'                 => ':attribute کا فیلڈ فائل ہونا ضروری ہے۔',
    'filled'               => ':attribute کا فیلڈ موجود ہونا ضروری ہے۔',
    'image'                => ':attribute کا فیلڈ تصویر ہونا ضروری ہے۔',
    'in'                   => 'منتخب کردہ :attribute غلط ہے۔',
    'in_array'             => ':attribute کا فیلڈ :other میں موجود نہیں ہے۔',
    'integer'              => ':attribute کا فیلڈ عدد ہونا ضروری ہے۔',
    'ip'                   => ':attribute کا فیلڈ درست IP ایڈریس ہونا ضروری ہے۔',
    'ipv4'                 => ':attribute کا فیلڈ درست IPv4 ایڈریس ہونا ضروری ہے۔',
    'ipv6'                 => ':attribute کا فیلڈ درست IPv6 ایڈریس ہونا ضروری ہے۔',
    'json'                 => ':attribute کا فیلڈ درست JSON سٹرنگ ہونا ضروری ہے۔',
    'max'                  => [
        'numeric' => ':attribute کا مقدار :max سے زیادہ نہیں ہو سکتا۔',
        'file'    => ':attribute کا سائز :max کلوبائٹ سے زیادہ نہیں ہو سکتا۔',
        'string'  => ':attribute کی لمبائی :max حروف سے زیادہ نہیں ہو سکتی۔',
        'array'   => ':attribute میں :max آئٹمز سے زیادہ نہیں ہو سکتے۔',
    ],
    'mimes'                => ':attribute کا فیلڈ :values کی صورت میں ہونا ضروری ہے۔',
    'mimetypes'            => ':attribute کا فیلڈ :values کی صورت میں ہونا ضروری ہے۔',
    'min'                  => [
        'numeric' => ':attribute کا مقدار :min سے کم نہیں ہو سکتا۔',
        'file'    => ':attribute کا سائز :min کلوبائٹ سے کم نہیں ہو سکتا۔',
        'string'  => ':attribute کی لمبائی :min حروف سے کم نہیں ہو سکتی۔',
        'array'   => ':attribute میں :min آئٹمز سے کم نہیں ہو سکتے۔',
    ],
    'not_in'               => 'منتخب کردہ :attribute غلط ہے۔',
    'numeric'              => ':attribute کا فیلڈ عدد ہونا ضروری ہے۔',
    'present'              => ':attribute کا فیلڈ موجود ہونا ضروری ہے۔',
    'regex'                => ':attribute کا فارمیٹ غلط ہے۔',
    'required'             => ':attribute کا فیلڈ درکار ہے۔',
    'required_if'          => ':attribute کا فیلڈ :other کی قیمت :value ہونے پر درکار ہے۔',
    'required_unless'      => ':attribute کا فیلڈ :other کی قیمت :values میں نہ ہونے پر درکار ہے۔',
    'required_with'        => ':attribute کا فیلڈ :values موجود ہونے پر درکار ہے۔',
    'required_with_all'    => ':attribute کا فیلڈ :values موجود ہونے پر درکار ہے۔',
    'required_without'     => ':attribute کا فیلڈ :values موجود نہ ہونے پر درکار ہے۔',
    'required_without_all' => ':attribute کا فیلڈ کوئی بھی :values موجود نہ ہونے پر درکار ہے۔',
    'same'                 => ':attribute اور :other مماثل ہونا ضروری ہے۔',
    'size'                 => [
        'numeric' => ':attribute کا مقدار :size ہونا ضروری ہے۔',
        'file'    => ':attribute کا سائز :size کلوبائٹ ہونا ضروری ہے۔',
        'string'  => ':attribute کی لمبائی :size حروف ہونی ضروری ہے۔',
        'array'   => ':attribute میں :size آئٹمز ہونے ضروری ہیں۔',
    ],
    'string'               => ':attribute کا فیلڈ متن ہونا ضروری ہے۔',
    'timezone'             => ':attribute کا فیلڈ درست زون ہونا ضروری ہے۔',
    'unique'               => ':attribute کا فیلڈ پہلے ہی استعمال ہو چکا ہے۔',
    'uploaded'             => ':attribute کا فیلڈ اپ لوڈ کرنا ناکام ہوگیا۔',
    'url'                  => ':attribute کا فیلڈ درست فارمیٹ ہونا ضروری ہے۔',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'user' => [
        'replacement_user_id' => [
            'required' => 'براہ مہربانی صرف ایک منتخب کریں۔',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
