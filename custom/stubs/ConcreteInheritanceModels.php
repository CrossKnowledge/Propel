<?php

namespace CustomStubs;

use CK\Runtime\Lib\Exception\PropelException;
use CK\Runtime\Lib\Propel;
use CK\Runtime\Lib\Connection\PropelPDO;
use Codernix\Debugger\Data;
use PDO;
use Exception;

class ConcreteInheritanceModels
{
    /**
     * @throws PropelException
     */
    public static function ensureTablesExist(): void
    {
        echo "🛠️ Ensuring all necessary tables and columns exist...\n";

        /** @var PropelPDO $con */
        $con = Propel::getConnection('bookstore');
        $stmt = $con->prepare("SELECT DATABASE()");
        $stmt->execute();
        $dbName = $stmt->fetchColumn();

        echo "🔌 Connected to DB: $dbName\n";

        $tables = [
            'concrete_author' => [
                'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
                'name' => 'VARCHAR(255)'
            ],
            'concrete_article' => [
                'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
                'title' => 'VARCHAR(255)',
                'author_id' => 'INT'
            ],
            'concrete_comment' => [
                'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
                'message' => 'TEXT',
                'body' => 'TEXT',
                'concrete_content_id' => 'INT'
            ]
        ];

        foreach ($tables as $table => $columns) {
            if (!self::tableExists($con, $dbName, $table)) {
                echo "ℹ️ Creating missing table: $table\n";
                $cols = implode(", ", array_map(
                    fn($name, $type) => "`$name` $type",
                    array_keys($columns),
                    $columns
                ));
                $con->exec("CREATE TABLE `$table` ($cols)");
            } else {
                foreach ($columns as $column => $type) {
                    if (!self::columnExists($con, $dbName, $table, $column)) {
                        echo "ℹ️ Adding missing column '$column' to table '$table'\n";
                        $con->exec("ALTER TABLE `$table` ADD `$column` $type");
                    }
                }
            }
        }

        echo "✅ DB schema verification complete.\n\n";
    }

    protected static function tableExists(PDO $pdo, string $dbName, string $table): bool
    {
        $stmt = $pdo->prepare(
            "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = ? AND table_name = ?"
        );
        $stmt->execute([$dbName, $table]);
        return $stmt->fetchColumn() > 0;
    }

    protected static function columnExists(PDO $pdo, string $dbName, string $table, string $column): bool
    {
        $stmt = $pdo->prepare(
            "SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = ? AND table_name = ? AND column_name = ?"
        );
        $stmt->execute([$dbName, $table, $column]);
        return $stmt->fetchColumn() > 0;
    }
}

class ConcreteAuthor
{
    public int $id;
    public string $name;

    public function setName(string $name): void { $this->name = $name; }

    /**
     * @throws PropelException
     */
    public function save(): int
    {
        $con = Propel::getConnection('bookstore');
        $stmt = $con->prepare("INSERT INTO concrete_author (name) VALUES (?)");
        $stmt->execute([$this->name]);
        $this->id = $con->lastInsertId();
        echo "👤 Saved ConcreteAuthor: {$this->name} (ID: {$this->id})\n";

        return $this->id;
    }
}

abstract class ConcreteContent
{
    public int $id;
    public ?ConcreteAuthor $author = null;

    public function setAuthor(ConcreteAuthor $author): void { $this->author = $author; }
}

class ConcreteArticle extends ConcreteContent
{
    protected static PropelPDO $con;
    protected static string $table = 'concrete_article';

    public int $id; //Made public for testing purposing to show the last inserted ID
    protected int $authorId;
    protected string $title;
    protected string $body;
    public ?ConcreteAuthor $author = null;

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setAuthorId(ConcreteAuthor $author): void {
        $this->authorId = $author->id;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @throws PropelException
     */
    public function save(): void
    {
        $con = Propel::getConnection('bookstore');
        $stmt = $con->prepare("INSERT INTO concrete_article (title, body, author_id) VALUES (?, ?, ?)");
        $stmt->execute([$this->title, $this->body, $this->authorId ?? null]);
        $this->id = $con->lastInsertId();
        echo "📝 Saved ConcreteArticle: {$this->title}, registered under ID: {$this->id}\n";
    }
}

class ConcreteComment extends ConcreteContent
{
    protected static PropelPDO $con;
    readonly protected string $table;
    protected string $title;
    public string $message;
    public int $concreteContentId;
    public int $article_id;

    public function __construct()
    {
        $this->table = 'concrete_comment';
    }

    public function setArticleId(ConcreteArticle $article): void {
        $this->article_id = $article->id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setMessage(string $msg): void { $this->message = $msg; }

    /**
     * @throws PropelException
     */
    public function save(): void
    {
        $con = Propel::getConnection('bookstore');
        $stmt = $con->prepare("INSERT INTO {$this->table} (article_id, body, message, concrete_content_id) VALUES (?, ?, ?, ?)");
        $stmt->execute(
            [
                $this->article_id,
                $this->message,
                $this->message,
                $this->concreteContentId ?? null
            ]
        );
        $this->concreteContentId = $con->lastInsertId();
        echo "💬 Saved ConcreteComment: {$this->message}, registered under ID: {$this->concreteContentId}\n";
    }
}
