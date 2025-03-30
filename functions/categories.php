<?php

/**
 * Prosledi se PDO objekat.
 * Vraca sve kategorije sa pridruzenim admin nalogom.
 *
 * @param PDO $pdo
 * @return array
 */
function fetchCategories(PDO $pdo): array
{
    $sql = "SELECT product_category.id, product_category.name, admin.username FROM product_category JOIN admin ON product_category.created_by = admin.id ORDER BY name ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Povlaci kategoriju putem ID
 *
 * @param PDO $pdo
 * @param int $id
 * @return array
 */
function fetchCategoryById(PDO $pdo, int $id): array
{
    $sql = "SELECT product_category.id, product_category.name, admin.username FROM product_category JOIN admin ON product_category.created_by = admin.id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

/**
 * Povlaci kategoriju pomocu imena
 *
 * @param PDO $pdo
 * @param string $name
 * @return array
 */
function fetchCategoryByName(PDO $pdo, string $name): array
{
    $sql = "SELECT product_category.id, product_category.name, admin.username FROM product_category JOIN admin ON product_category.created_by = admin.id WHERE name = :name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name]);
    return $stmt->fetch();
}

function deleteCategory(PDO $pdo, int $id): bool
{
    $sql = "DELETE FROM product_category WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

function createCategory(PDO $pdo, string $name, int $id): bool
{
    $sql = "INSERT INTO product_category (name, created_by) VALUES (:name, :id)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['name' => $name, 'id' => $id]);
}

function updateCategory(PDO $pdo, int $id, string $name): bool
{
    $sql = "UPDATE product_category SET name = :name WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['name' => $name, 'id' => $id]);
}