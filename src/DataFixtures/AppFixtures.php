<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $password_encoder)
    {
        $this->password_encoder = $password_encoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach($this->getUserData() as [$email, $password, $roles])
        {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($this->password_encoder->encodePassword($user,$password));
            $user->setRoles($roles);

            $manager->persist($user);
        }

        foreach($this->getPostData() as [$title,$abstract,$text])
        {
            $post = new Post();
            $post->setTitle($title);
            $post->setAbstract($abstract);
            $post->setText($text);

            $manager->persist($post);
        }

        $manager->flush();

        $this->loadLikes($manager);
    }


    public function loadLikes($manager)
    {

        for ($j = 0; $j < mt_rand(1, 20); $j++) {
            $post = $manager->getRepository(Post::class)->find(mt_rand(1, 8));
            $user_get = $manager->getRepository(User::class)->find(mt_rand(1, 3));
            $post->addLike($user_get);
            $manager->persist($post);
        }

        $manager->flush();
    }    

    private function getUserData(): array
    {
        return [
            ['luca.serio.dev@gmail.com', 'password', ['ROLE_USER']],
            ['serio@infotel.it', 'password', ['ROLE_USER']],
            ['luca.serio@webit.it', 'password', ['ROLE_USER']],
        ];
    }

    private function getPostData(): array
    {
        return [
            ['Aut architecto voluptatem modi omnis molestiae.', 'Expedita at sed in nisi corrupti ipsum sint. Magni est id rerum qui. Distinctio a maxime veritatis beatae tempore.','<p>Repudiandae error dolor unde ducimus quos molestiae. Dolor non officiis sint. Voluptates et et laboriosam ad fugit quos et.,Maxime vero aut quo nisi optio. Et et delectus voluptatum repudiandae neque. Sit fugit id incidunt illum quaerat voluptatum. Eum nesciunt eveniet sit molestiae sit occaecati quia.,Maxime quaerat minus repellendus numquam aspernatur velit. Et nemo accusantium quam fuga exercitationem officia sed. Enim voluptas sed blanditiis reiciendis quas ipsam voluptas consectetur.</p>'],
            ['Doloribus voluptates qui libero nam quia recusandae.', 'Expedita at sed in nisi corrupti ipsum sint. Magni est id rerum qui. Distinctio a maxime veritatis beatae tempore.','<p>Repudiandae error dolor unde ducimus quos molestiae. Dolor non officiis sint. Voluptates et et laboriosam ad fugit quos et.,Maxime vero aut quo nisi optio. Et et delectus voluptatum repudiandae neque. Sit fugit id incidunt illum quaerat voluptatum. Eum nesciunt eveniet sit molestiae sit occaecati quia.,Maxime quaerat minus repellendus numquam aspernatur velit. Et nemo accusantium quam fuga exercitationem officia sed. Enim voluptas sed blanditiis reiciendis quas ipsam voluptas consectetur.</p>'],
            ['Ut et laboriosam aut nam assumenda.', 'Expedita at sed in nisi corrupti ipsum sint. Magni est id rerum qui. Distinctio a maxime veritatis beatae tempore.','<p>Repudiandae error dolor unde ducimus quos molestiae. Dolor non officiis sint. Voluptates et et laboriosam ad fugit quos et.,Maxime vero aut quo nisi optio. Et et delectus voluptatum repudiandae neque. Sit fugit id incidunt illum quaerat voluptatum. Eum nesciunt eveniet sit molestiae sit occaecati quia.,Maxime quaerat minus repellendus numquam aspernatur velit. Et nemo accusantium quam fuga exercitationem officia sed. Enim voluptas sed blanditiis reiciendis quas ipsam voluptas consectetur.</p>'],
            ['Eum incidunt quod animi aperiam molestiae quia.roduzione', 'Expedita at sed in nisi corrupti ipsum sint. Magni est id rerum qui. Distinctio a maxime veritatis beatae tempore.','<p>Repudiandae error dolor unde ducimus quos molestiae. Dolor non officiis sint. Voluptates et et laboriosam ad fugit quos et.,Maxime vero aut quo nisi optio. Et et delectus voluptatum repudiandae neque. Sit fugit id incidunt illum quaerat voluptatum. Eum nesciunt eveniet sit molestiae sit occaecati quia.,Maxime quaerat minus repellendus numquam aspernatur velit. Et nemo accusantium quam fuga exercitationem officia sed. Enim voluptas sed blanditiis reiciendis quas ipsam voluptas consectetur.</p>'],
            ['Ducimus alias quo aut temporibus voluptatem.', 'Expedita at sed in nisi corrupti ipsum sint. Magni est id rerum qui. Distinctio a maxime veritatis beatae tempore.','<p>Repudiandae error dolor unde ducimus quos molestiae. Dolor non officiis sint. Voluptates et et laboriosam ad fugit quos et.,Maxime vero aut quo nisi optio. Et et delectus voluptatum repudiandae neque. Sit fugit id incidunt illum quaerat voluptatum. Eum nesciunt eveniet sit molestiae sit occaecati quia.,Maxime quaerat minus repellendus numquam aspernatur velit. Et nemo accusantium quam fuga exercitationem officia sed. Enim voluptas sed blanditiis reiciendis quas ipsam voluptas consectetur.</p>'],
            ['Hic eum fuga occaecati quis.', 'Expedita at sed in nisi corrupti ipsum sint. Magni est id rerum qui. Distinctio a maxime veritatis beatae tempore.','<p>Repudiandae error dolor unde ducimus quos molestiae. Dolor non officiis sint. Voluptates et et laboriosam ad fugit quos et.,Maxime vero aut quo nisi optio. Et et delectus voluptatum repudiandae neque. Sit fugit id incidunt illum quaerat voluptatum. Eum nesciunt eveniet sit molestiae sit occaecati quia.,Maxime quaerat minus repellendus numquam aspernatur velit. Et nemo accusantium quam fuga exercitationem officia sed. Enim voluptas sed blanditiis reiciendis quas ipsam voluptas consectetur.</p>'],
            ['Aliquam ratione maxime voluptates sunt enim explicabo doloribus.', 'Expedita at sed in nisi corrupti ipsum sint. Magni est id rerum qui. Distinctio a maxime veritatis beatae tempore.','<p>Repudiandae error dolor unde ducimus quos molestiae. Dolor non officiis sint. Voluptates et et laboriosam ad fugit quos et.,Maxime vero aut quo nisi optio. Et et delectus voluptatum repudiandae neque. Sit fugit id incidunt illum quaerat voluptatum. Eum nesciunt eveniet sit molestiae sit occaecati quia.,Maxime quaerat minus repellendus numquam aspernatur velit. Et nemo accusantium quam fuga exercitationem officia sed. Enim voluptas sed blanditiis reiciendis quas ipsam voluptas consectetur.</p>'],
            ['Neque facilis consequatur quo eos officia qui.', 'Expedita at sed in nisi corrupti ipsum sint. Magni est id rerum qui. Distinctio a maxime veritatis beatae tempore.','<p>Repudiandae error dolor unde ducimus quos molestiae. Dolor non officiis sint. Voluptates et et laboriosam ad fugit quos et.,Maxime vero aut quo nisi optio. Et et delectus voluptatum repudiandae neque. Sit fugit id incidunt illum quaerat voluptatum. Eum nesciunt eveniet sit molestiae sit occaecati quia.,Maxime quaerat minus repellendus numquam aspernatur velit. Et nemo accusantium quam fuga exercitationem officia sed. Enim voluptas sed blanditiis reiciendis quas ipsam voluptas consectetur.</p>'],
        ];
    }
}
