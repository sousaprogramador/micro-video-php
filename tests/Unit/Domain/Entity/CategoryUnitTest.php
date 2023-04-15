<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
  public function testAttributes()
  {
    $category = new Category(
      name: 'New Cat',
      description: 'New desc',
      isActive: true
    );

    $this->assertNotEmpty($category->id());
    $this->assertEquals('New Cat', $category->name);
    $this->assertEquals('New desc', $category->description);
    $this->assertEquals(true, $category->isActive);
  }

  public function testActivated()
  {
    $category = new Category(
      name: 'New Cat',
      isActive: false,
    );

    $this->assertFalse($category->isActive);

    $category->activate();

    $this->assertTrue($category->isActive);
  }

  public function testDisable()
  {
    $category = new Category(
      name: 'New Cat',
    );

    $this->assertTrue($category->isActive);

    $category->disable();

    $this->assertFalse($category->isActive);
  }

  public function testUpdate()
  {
    $uuid = (string) Uuid::uuid4()->toString();

    $category = new Category(
      id: $uuid,
      name: 'New Cat',
      description: 'New desct',
      isActive: true
    );

    $category->update(
      name: 'new_cat',
      description: 'new_desct',
    );

    $this->assertEquals('new_cat', $category->name);
    $this->assertEquals('new_desct', $category->description);
  }

  public function testExceptionName()
  {
    try {
      $category = new Category(
        name: 'Ne',
        description: 'New desct',
        isActive: true
      );
      $this->assertTrue(false);
    } catch (\Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th);
    }
  }

  public function testExceptionDescription()
  {
    try {
      new Category(
        name: 'Name Cat',
        description: random_bytes(999999)
      );

      $this->assertTrue(false);
    } catch (\Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th);
    }
  }
}
