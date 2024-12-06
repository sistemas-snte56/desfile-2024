<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'select_delegacion' => ['required'],
            'select_genero' => ['required'],
            'select_cargo' => ['required'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        /*
            return User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        */

        $user = User::create([
            'id_delegacion' => $input['select_delegacion'],
            'id_genero' => $input['select_genero'],
            'cargo' => $input['select_cargo'],
            'nombre' => mb_strtoupper($input['nombre'],'UTF-8'),
            'apaterno' => mb_strtoupper($input['apellido_paterno'],'UTF-8'),
            'amaterno' => mb_strtoupper($input['apellido_materno'],'UTF-8'),
            'email' => $input['email'],
            'status_lista' => 0,
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole('Usuario');

        return $user;
    }
}

//$region->region = mb_strtoupper($request->input('region'),'UTF-8') ;
        


/*

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_delegacion` bigint unsigned NOT NULL,
  `id_genero` bigint unsigned NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apaterno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amaterno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_lista` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_genero_foreign` (`id_genero`),
  KEY `users_id_delegacion_foreign` (`id_delegacion`),
  CONSTRAINT `users_id_delegacion_foreign` FOREIGN KEY (`id_delegacion`) REFERENCES `delegations` (`id`),
  CONSTRAINT `users_id_genero_foreign` FOREIGN KEY (`id_genero`) REFERENCES `genres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci


*/