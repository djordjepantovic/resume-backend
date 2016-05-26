<?php

namespace Resume\Controllers;

use Resume\Core\Controller as BaseController;
use Resume\Models\Home as HomeModel;
use Resume\Services\Validation;
use Resume\Helpers\Config;
use Resume\Helpers\Ajax;
use Mailgun\Mailgun;

class Home extends BaseController
{
    public function index()
    {
        $profile = HomeModel::all('profile')->get()->fetch();
        $address = HomeModel::all('address')->get()->fetch();
        $socialList = HomeModel::all('social')->get()->fetchAll();
        $educations = HomeModel::all('education')->desc('id')->get();
        $expiriences = HomeModel::all('expirience')->desc('id')->get();
        $techSkills = HomeModel::all('tech_skills')->get();
        $toolSkills = HomeModel::all('tool_skills')->get();
        $languages = HomeModel::all('languages')->get();
        $certifications = HomeModel::all('certification')->get();
        $funfacts = HomeModel::all('funfact')->get();
        $interests = HomeModel::all('interest')->get();

        echo $this->view->render('home.twig', [
            'profile'         => $profile,
            'address'         => $address,
            'socialList'      => $socialList,
            'educations'      => $educations,
            'expiriences'     => $expiriences,
            'techSkills'      => $techSkills,
            'toolSkills'      => $toolSkills,
            'languages'       => $languages,
            'certifications'  => $certifications,
            'funfacts'        => $funfacts,
            'interests'       => $interests,
        ]);
    }

    public function send(Mailgun $mail, Validation $validator)
    {
        if (Ajax::isXHR()) {
            $params = [];
            
            foreach ($_POST as $field => $value) {
                $params[$field] = htmlspecialchars(trim($value));
            }

            $validator->make($params, [
                'name'  => 'required',
                'email' => 'email|required',
                'message' => 'required'
            ]);

            if ($validator->fails()) {
                Ajax::jsonError($validator->errors());
            }

            $subject = (!empty($params['subject'])) ? $params['subject'] : 'New message from Resume!';

            $mail->sendMessage(Config::get('MAIL_DOMAIN'), [
                'from' => $params['email'],
                'to'   => Config::get('MAIL_ADDRESS'),
                'subject' => $subject,
                'html' => '<p>'. $params['message'] .'</p>'
            ]);

            Ajax::jsonSuccess('Your message has been sent successfully');
        }
    }
}