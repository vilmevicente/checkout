<?php

namespace App\Http\Controllers;

use App\Models\checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainProduct = [
        'id' => 1,
        'name' => 'Curso Completo de Marketing Digital',
        'price' => 297,
        'originalPrice' => 497,
        'principalbanner' => '/placeholder.svg',
        'description' => 'Aprenda as estratégias mais eficazes de marketing digital com nosso curso completo. Desde o básico até técnicas avançadas, este curso é ideal para quem deseja dominar o marketing online e impulsionar seus negócios ou carreira.',
        'secondarybanner' => '/placeholder.svg',
        'features' => [
            'Acesso vitalício ao conteúdo do curso',
    ];

    $upsells = [
        ['id' => 'up1', 'name' => 'Instagram Ads Avançado', 'price' => 97, 'originalPrice' => 197, 'discount' => '50% OFF', 'image' => '/placeholder.svg'],
        ['id' => 'up2', 'name' => 'Templates Premium', 'price' => 47, 'originalPrice' => 97, 'discount' => '52% OFF', 'image' => '/placeholder.svg'],
    ];

    $depoimentos = [
        ['name' => 'João Silva', 'text' => 'Esse curso mudou minha vida! Aprendi tudo sobre marketing digital e já estou vendo resultados incríveis.', 'image' => '/placeholder.svg', 'username' => '@joaosilva'],
        ['name' => 'Maria Oliveira', 'text' => 'Conteúdo de alta qualidade e muito bem explicado. Recomendo para todos que querem se aprofundar no marketing digital.', 'image' => '/placeholder.svg', 'username' => '@mariaoliveira'],
        ['name' => 'Carlos Souza', 'text' => 'Os bônus são fantásticos! Vale muito a pena pelo preço que paguei. Já estou aplicando o que aprendi.', 'image' => '/placeholder.svg', 'username' => '@carlossouza'],
    ];

    return view('checkout', [
        'mainProduct' => $mainProduct,
        'upsells' => $upsells,
        'total' => $mainProduct['price'],
        'depoimentos' => $depoimentos,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(checkout $checkout)
    {
        //
    }
}
