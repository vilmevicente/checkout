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
            '0' => ['name' => 'Acesso Imediato!', 'description' => 'Utilize já após a compra', 'icon' => 'fas fa-bolt'],
            '1' => ['name' => 'Suporte Exclusivo!', 'description' => 'Através do WhatsApp', 'icon' => 'fab fa-whatsapp'],
            '2' => ['name' => 'Treinamento VIP!', 'description' => 'Todas as funcionalidades', 'icon' => 'fas fa-crown'],
        ],
      
    
    ];

    $upsells = [
        ['id' => 'up1', 'name' => 'Instagram Ads Avançado', 'price' => 97, 'originalPrice' => 197, 'discount' => '50% OFF', 'image' => 'https://assets.kiwify.com.br/cdn-cgi/image/fit=scale-down,width=64/aIr8nqdegLp8KtQ/NOVO_ZAP_02_bcbd62709f224ab6b0cbc64de782d6dd.png'],
        ['id' => 'up2', 'name' => 'Templates Premium', 'price' => 47, 'originalPrice' => 97, 'discount' => '52% OFF', 'image' => 'https://assets.kiwify.com.br/cdn-cgi/image/fit=scale-down,width=64/aIr8nqdegLp8KtQ/NOVO_ZAP_02_bcbd62709f224ab6b0cbc64de782d6dd.png'],
    ];

    $depoimentos = [
        ['name' => 'João Silva', 'text' => 'Treinamento e ferramenta incrível! Todos os dias tenho novos clientes.', 'image' => '/placeholder.svg', 'username' => '@joaosilva'],
        ['name' => 'Maria Oliveira', 'text' => 'As aulas ao vivo e a ferramenta são excelentes! Parabéns à equipe.', 'image' => 'https://i.pravatar.cc/60?img=32', 'username' => '@mariaoliveira'],
       
    ];

    return view('checkout', [
        'mainProduct' => $mainProduct,
        'upsells' => $upsells,
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
