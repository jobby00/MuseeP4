<?php
namespace Tests\JD\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationControllerTest extends  WebTestCase
{
    public function testjd_reservation_index()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
    /**
    public function testJd_reservation_startReservation()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $link = $crawler->selectLink('Reservez vos billets')->link();
        $crawler  = $client->click($link);
        $client->followRedirects();

        $form = $crawler->selectButton('Suivant')->form();
        $crawler = $client->submit($form, [
            'jd_louvrebundle_reservation[email]' => 'jobby00@gmail.com',
            'jd_louvrebundle_reservation[nbBillets]' => 1
        ]);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
*/

    public function testJd_reservation_startBillets()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $link = $crawler->selectLink('Reservez vos billets')->link();
        $client->followRedirects();
        $crawler  = $client->click($link);


        $form = $crawler->selectButton('Suivant')->form();
        $crawler = $client->submit($form, [
            'jd_louvrebundle_reservation[email]' => 'jobby00@gmail.com',
            'jd_louvrebundle_reservation[nbBillets]' => 1
        ]);

        $form = $crawler->selectButton('Suivant')->form();
        $form['jd_louvrebundle_billets[nom]'] = 'Doe';
        $form['jd_louvrebundle_billets[prenom]'] = 'John';
        $form['jd_louvrebundle_billets[pays]']->select('FR');
        $form['jd_louvrebundle_billets[dateNaissance][day]']->select('12');
        $form['jd_louvrebundle_billets[dateNaissance][month]']->select('5');
        $form['jd_louvrebundle_billets[dateNaissance][year]']->select('1974');
       // $form['jd_louvrebundle_billets[tarifReduit]']->tick();
        $form['jd_louvrebundle_billets[dateresa]'] = '28/04/2018';
        $form['jd_louvrebundle_billets[demijournee]']->select('1');
        $crawler = $client->submit($form);
        $this->assertSame(200, $client->getResponse()->getStatusCode());

    }
}