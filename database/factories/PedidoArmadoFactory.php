<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Pedido;
use App\Models\Armado;
use App\Models\PedidoArmado;
use Faker\Generator as Faker;

$factory->define(PedidoArmado::class, function (Faker $faker) {
    $armado = $faker->randomElement(Armado::all());
    $pedido = $faker->randomElement(Pedido::all());
    $usuario = $faker->randomElement(User::where('acceso', '1')->get()->pluck('email_registro'));
    return [
        'cod'                   => $pedido->serie.$pedido->id.'-'.$faker->stateAbbr,
        'cant'                  => '1',
        'tip'                   => $armado->tip,
        'nom'                   => $armado->nom,
        'sku'                   => $armado->sku,
        'gama'                  => $armado->gama,
        'prec'                  => $armado->prec_redond,
        'pes'                   => $armado->pes,
        'alto'                  => $armado->alto,
        'ancho'                 => $armado->ancho,
        'largo'                 => $armado->largo,
        'regalo'                => 'No',
        'pedido_id'             => $pedido->id,
        'created_at_ped_arm'    => $usuario,
    ];
});