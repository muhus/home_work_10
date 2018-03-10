<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    /**
     * @Route("/article", name="article")
     */
    public function index(EntityManagerInterface $manager)
    {
        $category = new Category();
        $category->setName('Категорія');

        $tagA= new Tag();
        $tagA->setName('Тег1');
        $tagB= new Tag();
        $tagB->setName('Тег2');
        $tagC= new Tag();
        $tagC->setName('Тег3');

        for ($i=1; $i<3; $i++) {

            $article = new Article();
            $article->setName('Стаття'.$i);
            $article->setContent('Контент для статті -'.$i);
            $article->setCategory($category);

            for ($n=0; $n<3; $n++) {
                $comment = new Comment();
                $comment->setName('Коментар'.$n);
                $comment->setContent('Текст комента - '.$n);
                $comment->setArticle($article);
                $manager->persist($comment);
            }

            if($i==1){$article->addTag($tagA);$article->addTag($tagB);}
            elseif ($i==2){$article->addTag($tagB);$article->addTag($tagC);}

            $manager->persist($article);
            }
            $manager->flush();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
}
