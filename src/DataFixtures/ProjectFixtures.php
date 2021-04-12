<?php


namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends BaseFixture
{
    public const PROJECT_1_REFERENCE = 'Project No1';
    public const PROJECT_2_REFERENCE = 'Project No2';
    public const PROJECT_3_REFERENCE = 'Project No3';

    protected function loadData(ObjectManager $manager)
    {
        foreach (self::getProjectNames() as $name) {
            $project = new Project();
            $project->setName($name);
            $manager->persist($project);

            $this->addReference($name, $project);
        }
        $manager->flush();
    }

    public static function getProjectNames(): array
    {
        return [
            self::PROJECT_1_REFERENCE,
            self::PROJECT_2_REFERENCE,
            self::PROJECT_3_REFERENCE,
        ];
    }
}