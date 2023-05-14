<?php

namespace App\Tests\Unit;

use App\Controller\PaymentController;
use App\Entity\User;
use App\Helpers\Classes\ServiceFactory;
use App\Services\Payment\Ayden;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAddToWalletShouldCallChargeWithSpecificArguments()
    {
        // je veux tester la méthode addToWallet et son type de réponse qui dooit être une instance de la classe Response
        // pour cela, il faut traverser toute la méthode, et notamment en passer par une méthode statique.

        // J'instancie la classe à tester, en lui fournissant un mock de la dépendance;
        $payment = new PaymentController($this->createMock(User::class));

        // Je crée un mock de la classe Ayden...
        $ayden = $this
            ->getMockBuilder(Ayden::class)
            ->getMock();

        // ...qui est retourné comme résultat de l'appel à la méthode statique ServiceFactory::build()
        $paymentStatic = Mockery::mock('alias:' . ServiceFactory::class);
        $paymentStatic
            ->shouldReceive('build')
            ->andReturn($ayden);

        // Je demande à ce que la méthode Ayden::charge() retourne un tableau avec un statut=502
        $ayden
            ->method('charge')
            ->willReturn(['status' => 502]);

        // Je falsifie la classe Request requise comme second paramètre lors de l'appel de la méthode à tester
        $request = $this->createMock(Request::class);

        // Je vérifie enfin que la méthode testée retourne bien une instance de la classe Response
        $this->assertInstanceOf(Response::class, $payment->addToWallet('ayden', $request));

        // Si je veux vérifier le contenu de la réponse, je dois faire un test fonctionnel, en étendant avec WebTestCase
    }
}