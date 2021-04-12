<?php


namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use function uniqid;

class TaskFixtures extends BaseFixture implements  DependentFixtureInterface
{
    private ?\DateTime $start = null;
    private ?\DateTime $end = null;

    protected function loadData(ObjectManager $manager)
    {
        $this->start = new \DateTime('Monday next week');
        $this->end = new \DateTime('Friday next week');

        $users = $this->getUsers();
        $projects = $this->getProjects();
        foreach ($projects as $project) {
            $this->addProjectTasks($project, $users);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjectFixtures::class,
            UserFixtures::class,
        ];
    }

    /**
     * @param Project $project
     * @param User[] $users
     */
    private function addProjectTasks(Project $project, array $users)
    {
        foreach ($users as $user) {
            $this->createWeekTasks($project, $user);
        }
    }

    private function createWeekTasks(Project $project, User $user)
    {
        $current = clone $this->start;
        while ($current < $this->end) {
            $task = new Task();
            $task
                ->setName(uniqid('name_', true))
                ->setExecutor($user)
                ->setProject($project)
                ->setStatus(Task::STATUS_CREATED)
                ->setStart(clone $current)
                ->setFinish(clone ($current->add(new \DateInterval('P1D'))))
            ;
            $this->manager->persist($task);
        }
    }

    private function getUsers(): array
    {
        return array_map(fn ($email) => $this->getReference($email), UserFixtures::getUserEmails());
    }

    private function getProjects(): array
    {
        return array_map(fn ($name) => $this->getReference($name), ProjectFixtures::getProjectNames());
    }

}