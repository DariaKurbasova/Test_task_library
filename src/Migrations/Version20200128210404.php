<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128210404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, year SMALLINT(4) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Демо-данные для главной страницы
        $this->addSql("INSERT INTO book(id, title, author, year) VALUES
                          (1, 'Отцы и дети', 'Тургенев И.С.', 1883),
                          (2, 'Гарри Поттер и Дары Смерти', 'Роулинг Джоан', 2007),
                          (3, 'Тарас Бульба', 'Гоголь Н.В.', 1835),
                          (4, 'Анна Каренина', 'Толстой Л.Н.', 1875),
                          (5, 'Мастер и Маргарита', 'Булгагов М.А.', 1967),
                          (6, 'Женщина в белом', 'Коллинз Уилки', 1860),
                          (7, 'Процесс', 'Кафка Франц', 1925),
                          (8, 'Зов Ктулху', 'Лавкрафт Г.Ф.', 1928),
                          (9, 'Сияние', 'Кинг Стивен', 1977),
                          (10, 'Белые ночи', 'Достоевский Ф.М.', 1865)");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE book');
    }
}
