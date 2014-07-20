<?php
namespace SY\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

class LogRepository extends EntityRepository
{
    public function findHits($ip)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT l
                    FROM SYWebBundle:Log l
                    WHERE l.ip = :ip
                    AND l.date like :fec'
            )
            ->setParameter('ip', $ip)
            ->setParameter('fec', '%' . date('Y-m-d') . '%'
            )->getResult();
    }
}
