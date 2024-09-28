<?php
namespace Src\Controllers;

use Src\Components\PageComponent\PageComponent;
use Src\Components\PageComponent\UisPartnershipPageComponent\UisPartnershipPageComponent;

class UisPartnershipController extends Controller
{
    protected function generatePage(): PageComponent
    {
        $page = new UisPartnershipPageComponent();

        $page->setItems([
            'seo-data' => [
                [
                    'title' => 'What is United Italian Societies',
                    'content' => 'UIS is a non-profit organization that connects Italian
                                    student associations in over 50 foreign universities,
                                    establishing a network of over 11,000 university students
                                    in the United Kingdom and many others in Ireland, France,
                                    Spain, Holland, United States and Switzerland.
                                    UIS promotes the Italian culture and the circulation of
                                    Italian talents, connecting them and enriching their
                                    international experiences.'
                ],
                [
                    'title' => 'Our partnership',
                    'content' => 'NOVAsbe Club Of Italy, in collaboration with United
                                    Italian Societies (UIS), will create the first ever Italian
                                    Society in Portugal, extending the network in a new
                                    country.
                                    Our aim is to facilitate cultural exchange and
                                    collaboration, enrichening the experience of all
                                    members while honoring our shared italian
                                    background. Through this partnership, we connect
                                    our members with a global network'
                ],
            ],
            'people' => [
                [
                    'name' => 'Umberto Belluzzo',
                    'role' => 'United Italian Societies - President',
                    'image' => '/public/assets/images/people/belluzzo.jpeg',
                    'content' => 'United Italian Societies is proud to support the Nova Club of Italy; we are confident that Michele and his team will play a crucial role in making the project a point of reference for Italian students undertaking studies at Nova School of Business and Economics.'
                ],
                [
                    'name' => 'Sara Chemello',
                    'role' => 'Morgan Stanley - CFO UIS',
                    'image' => '/public/assets/images/people/chemello.jpeg',
                    'content' => 'We are delighted to include the Nova Club of Italy in our extensive network of Italian Societies around the world and to be able to offer our free resources to the Italian students of Nova Business School. We are confident that the team will best support the students\' interests and strengthen the Italian community within Nova Business School.'
                ],
                /*[
                    'image' => '/public/assets/images/people/chemello.jpeg',
                    'content' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. Leo hac phasellus urna nibh elit senectus mattis. Eget dignissim vehicula euismod mi a. '
                ],*/
                [
                    'name' => 'Guglielmo Santamaria',
                    'role' => 'Banca d\'Italia - Managing Director UIS',
                    'image' => '/public/assets/images/people/santamaria.png',
                    'content' => 'UIS is very happy to be able to extend its initiatives and offer its services to Nova Business School students as well and trusts in the important initiative of the Nova Club of Italy team.'
                ],
            ]
        ]);

        return $page;
    }
}