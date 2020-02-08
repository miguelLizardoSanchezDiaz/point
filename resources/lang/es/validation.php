<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => ':attribute debe ser aceptado.',
    'active_url'           => ':attribute no es una URL válida.',
    'after'                => ':attribute debe ser una fecha posterior a :date.',
    'alpha'                => ':attribute solo debe contener letras.',
    'alpha_dash'           => ':attribute solo debe contener letras, números y guiones.',
    'alpha_num'            => ':attribute solo debe contener letras y números.',
    'array'                => ':attribute debe ser un conjunto.',
    'before'               => ':attribute debe ser una fecha anterior a :date.',
    'between'              => [
        'numeric' => ':attribute tiene que estar entre :min - :max.',
        'file'    => ':attribute debe pesar entre :min - :max kilobytes.',
        'string'  => ':attribute tiene que tener entre :min - :max caracteres.',
        'array'   => ':attribute tiene que tener entre :min - :max ítems.',
    ],
    'boolean'              => 'El campo :attribute debe ser 0 ó 1',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => ':attribute no es una fecha válida.',
    'date_format'          => ':attribute no corresponde al formato :format.',
    'different'            => ':attribute y :other deben ser diferentes.',
    'digits'               => ':attribute debe tener :digits dígitos.',
    'digits_between'       => ':attribute debe tener entre :min y :max dígitos.',
    'dimensions'           => 'Las dimensiones de la imagen :attribute no son validas.',
    'distinct'             => 'El campo :attribute contiene un valor duplicado.',
    'email'                => ':attribute no es un correo válido',
    'exists'               => ':attribute es inválido.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'image'                => ':attribute debe ser una imagen.',
    'in'                   => ':attribute es inválido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => ':attribute debe ser un número entero.',
    'ip'                   => ':attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe tener una cadena JSON válida.',
    'max'                  => [
        'numeric' => ':attribute no debe ser mayor a :max.',
        'file'    => ':attribute no debe ser mayor que :max kilobytes.',
        'string'  => ':attribute no debe ser mayor que :max caracteres.',
        'array'   => ':attribute no debe tener más de :max elementos.',
    ],
    'mimes'                => ':attribute debe ser un archivo con formato: :values.',
    'min'                  => [
        'numeric' => 'El tamaño de :attribute debe ser de al menos :min.',
        'file'    => 'El tamaño de :attribute debe ser de al menos :min kilobytes.',
        'string'  => ':attribute debe contener al menos :min caracteres.',
        'array'   => ':attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => ':attribute es inválido.',
    'numeric'              => 'El campo :attribute debe ser numérico.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato de :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values estén presentes.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El tamaño de :attribute debe ser :size.',
        'file'    => 'El tamaño de :attribute debe ser :size kilobytes.',
        'string'  => ':attribute debe contener :size caracteres.',
        'array'   => ':attribute debe contener :size elementos.',
    ],
    'string'               => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone'             => 'El :attribute debe ser una zona válida.',
    'unique'               => 'El :attribute ya ha sido registrado y debe ser único.',
    'url'                  => 'El formato :attribute es inválido.',

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

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
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

    'attributes'           => [
        'name'                  => 'nombre',
        'username'              => 'usuario',
        'email'                 => 'usuario',
        'first_name'            => 'nombre',
        'last_name'             => 'apellidos',
        'password'              => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
        'city'                  => 'ciudad',
        'country'               => 'país',
        'address'               => 'dirección',
        'phone'                 => 'teléfono',
        'mobile'                => 'móvil',
        'age'                   => 'edad',
        'sex'                   => 'sexo',
        'gender'                => 'género',
        'year'                  => 'año',
        'month'                 => 'mes',
        'day'                   => 'día',
        'hour'                  => 'hora',
        'minute'                => 'minuto',
        'second'                => 'segundo',
        'title'                 => 'título',
        'body'                  => 'contenido',
        'description'           => 'descripción',
        'excerpt'               => 'extracto',
        'date'                  => 'fecha',
        'time'                  => 'hora',
        'subject'               => 'asunto',
        'message'               => 'mensaje',
        'txt_codigo'            => 'Código',
        'txt_descripcion'       => 'Descripción',
        'txt_contraseña1'       => 'Contraseña',
        'txt_contraseña2'       => 'Contraseña',
        'txt_nombre'            => 'Nombre',
        'txt_telefono'            => 'Teléfono',
        'cborol'                => 'Rol',
        'txt_codestablecimiento'=> 'Código de Establecimiento',
        'txt_direccion'         => 'Dirección',
        'txt_sucursal'          => 'Sucursal',
        'txt_moneda'            => 'Moneda',
        'rb_tipo_moneda'        => 'Tipo de Moneda',
        'rb_es_consignacion'    => 'Es Consignación',
        'txt_cargo'             => 'Cargo',
        'txt_telefono'          => 'Telefono',
        'cbo_tipo_costo'        => 'Tipo de Costo',
        'txt_codalterno'        => 'Codigo Alterno',
        'cbo_tipo_piso'         => 'Piso',
        'cbo_tipo_techo'        => 'Techo',
        'txt_largo'             => 'Largo',
        'txt_ancho'             => 'Ancho',
        'txt_area'              => 'Area',
        'txt_ctacargo'          => 'Cuenta cargo',
        'txt_ctaabono'          => 'Cuenta abono',
        'txt_tipo_cuenta'       => 'Tipo Cuenta',
        'cbo_dbalance'          => 'Naturaleza de la Cuenta',
        'cbo_tipo_auxiliar'     => 'Tipo de Auxiliar',
        'cbo_tipo_ajuste'       => 'Tipo de Ajuste',
        'cbo_tipo_cambio'       => 'Tipo de Cambio',
        'ch_pide_ccosto'        => 'Exige Centro de Costo',
        'ch_pide_op'            => 'Pide Orden',
        'rb_es_titulo'          => 'Es Titulo',
        'txt_costo_hora'        => 'Costo por Hora',
        'txt_dias'              => 'Días de Crédito',
        'txt_factor'            => 'Factor',
        'rb_controlnum'         => 'Controlar Numeración',
        'rb_bloquear'           => 'Bloquear Numeración',
        'rb_verenrcompra'       => 'Mostrar Reg. Compras',
        'rb_verenrventa'        => 'Mostrar en el Reg. Ventas',
        'rb_origen'             => 'Origen',
        'txt_email'             => 'E-Mail',
        'password1'             => 'Confirmación contraseña',
        'txt_codigo_transaccion'=> 'Código Transacción',
        'txt_voucher'           => 'Voucher',
        //atributos by miguelayo
        'cbo_departamento'=>'Departamento',
        'cbo_provincia'=>'Provincia',
        'cbo_distrito'=>'Distrito',
        'txt_importe'=>'Importe',
        'txt_descripcion'=>'Descripción',
        'cat_codigo'=>'Código',
        
    ],

];
