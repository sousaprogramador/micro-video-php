<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
  public function testAttributes()
  {
    $category = new Category(
      name: 'New Cat',
      description: 'New desct',
      isActive: true
    );

    $this->assertEquals('New Cat', $category->name);
    $this->assertEquals('New desct', $category->description);
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
    $uuid = 'hash.value';

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
}
