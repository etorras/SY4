<?php

namespace SY\WebBundle\Controller;

use SY\WebBundle\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WebController extends Controller
{
    public function indexAction(Request $request)
    {
        $ref = '';
        if (isset($_SERVER['HTTP_REFERER'])) echo $ref = $_SERVER['HTTP_REFERER'];

        $em = $this->getDoctrine()->getManager();

        $config = [
            'browser' => 1,
            'agent' => 0,
            'ip' => 1,
            'os' => 1,
            'referrer' => 1,
            'max_hits' => 30
        ];

        $l = $em->getRepository('SYWebBundle:Log')->findHits($request->getClientIp());

        $hitsToday = count($l);

        if ($hitsToday<$config['max_hits']) {
            $log = new Log();
            $log->setDate(new \DateTime('now'));
            if ($config['browser'] == 1) {
                $log->setBrowser($this->getBrowser());
            }
            else {
                $log->setBrowser('');
            }
            if ($config['agent'] == 1) {
                $log->setAgent($_SERVER['HTTP_USER_AGENT']);
            }
            else {
                $log->setAgent('');
            }
            if ($config['ip'] == 1) {
                $log->setIp($request->getClientIp());
            }
            else{
                $log->setIp('');
            }
            if ($config['os'] == 1) {
                $log->setOS($this->getOS());
            }
            else{
                $log->setOS('');
            }
            if ($config['referrer'] == 1) {
                $log->setReferrer($ref);
            }
            else{
                $log->setReferrer('');
            }

            $em->persist($log);
            $em->flush();
        }

        return $this->render('SYWebBundle:Web:index.html.twig');
    }

    function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform    =   "Unknown OS Platform";
        $os_array       =   array(
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }
        }
        return $os_platform;
    }

    function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "Unknown Browser";
        $browser_array  =   array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Firefox',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Chrome',
            '/opera/i'      =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/konqueror/i'  =>  'Konqueror',
            '/mobile/i'     =>  'Handheld Browser'
        );
        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser    =   $value;
            }
        }
        return $browser;
    }

    public function resultAction()
    {
        $em = $this->getDoctrine()->getManager();

        $logs = $em->getRepository('SYWebBundle:Log')->findAll();

        return $this->render('SYWebBundle:Web:logs.html.twig', ['logs' => $logs]);
    }
}
