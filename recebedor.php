<?php 

require 'vendor/autoload.php';

use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

$httpClient = new GuzzleAdapter(new Client());
$sparky = new SparkPost($httpClient, ['key'=>'766f7bfb72c46dac0c288874f64d3d312ba9fc7b']);


	$envio = [
	    'content' => [
	        'from' => [
	            'name' => 'Escola Ayibobo',
	            'email' => 'contato@vcdiamante.com',
	        ],
	        'subject' => 'Nova Mensagem',
	        'html' => ' <h3 style="color: #343434;"><b>Você recebeu uma mensagem encaminhada do site da Escola Ayibobo :) 			</b></h3>
	        			
						<p>
							Nome: '.$_POST['nome'] .'
						</p>
						<p>
							Telefone: '.$_POST['telefone'] .'
						</p>
						<p>
							Mensagem: '.$_POST['mensagem'] .'
						</p>',
	        // 'text' => 'Congratulations, ' . '!! You just sent your very first mailing!',
	    ],

		'recipients' => [
	        [
	            'address' => [
	                'name' => 'Ayibobo - Línguas e literaturas',
	                'email' => 'frances.creolo@gmail.com',
	            ],
        	],
		],
    ];
	
	$promise = $sparky->transmissions->post($envio);



	$sparky->setOptions(['async' => false]);
	try {
	    $response = $sparky->transmissions->get();
	    
	    echo  json_encode(
	    	[
	    		'response' => true,
	    		'sucesso' => true,
	    	]
	    );
	}
	catch (\Exception $e) {
	   
	    echo  json_encode(
	    	[
	    		'response' => false,
	    		'sucesso' => false
	    	]
	    );
	}



?>
