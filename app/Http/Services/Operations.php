<?php

namespace App\Http\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Operations
{
    static function verificaId($value)
    {
        //verificar se id foi passado e se é válido - encriptado
        try {
            $id = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            // Handle the decryption error, e.g., redirect or show an error message
            return redirect()->route('home')->withErrors(['error' => 'Id inválido.']);
        }
        return $id;
    }

}