<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../runtime/lib/Propel.php';
require_once __DIR__ . '/stubs/ConcreteInheritanceModels.php';
require_once __DIR__ . '/stubs/ConcreteArticleQuery.php';
require_once __DIR__ . '/stubs/ConcreteCommentQuery.php';
require_once __DIR__ . '/stubs/Debugger.php';


use CK\Runtime\Lib\Exception\PropelException;
use CK\Runtime\Lib\Propel;
use Codernix\Debugger\Data;
use CustomStubs\ConcreteArticle;
use CustomStubs\ConcreteAuthor;
use CustomStubs\ConcreteComment;
use CustomStubs\ConcreteInheritanceModels;

echo "🧪 Testing Concrete Inheritance Behavior\n";

// Set up Propel
$config = require __DIR__ . '/config/bookstore-conf.php';

Propel::setConfiguration($config);

try {
    Propel::initialize();
} catch (PropelException|Exception $e) {}

try {
    $con = Propel::getConnection('bookstore');
    $con->beginTransaction();

    //Making sure we have the needed DB Tables
    ConcreteInheritanceModels::ensureTablesExist();

    // Insert Author
    $author = new ConcreteAuthor();
    $author->setName('John Doe');
    $author->save();

    // Insert Article (inherits from ConcreteContent)
    $article = new ConcreteArticle();
    $article->setTitle('Sample Article');
    $article->setBody('This is a sample article body.');
    $article->setAuthorId($author);
    $article->save();

    // Insert Comment on the content
    $comment = new ConcreteComment();
    $comment->setTitle('Propel Article \#: ' . hrtime(true));
    $comment->setMessage('Nice article!');
    $comment->setArticleId($article);
    $comment->save();

    $con->commit();

    echo "✅ Data inserted successfully.\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    $con->rollBack();
    exit(1);
}

echo "📦 Contents of concrete_article:\n";
$articles = ConcreteArticleQuery::create()->find();
Data::dump($articles);
foreach ($articles as $a) {
    $a = (object) $a;
    echo "  - ID: {$a->id}, Title: {$a->title}, Body: {$a->body}, Author: {$a->author_id}\n";
}

echo "💬 Comments:\n";
$comments = ConcreteCommentQuery::create()->find();
foreach ($comments as $c) {
    $c = (object) $c;
    echo "  - On Content ID: {$c->id}, Message: {$c->message}, Article ID: {$c->article_id}\n";
}
