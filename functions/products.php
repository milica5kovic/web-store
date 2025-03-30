<?php

function fetchProducts(PDO $pdo): array
{
    $sql = "SELECT product.id, product.category, product.name, product.description, product.image_url AS image, product.price, product_category.name AS category_name, admin.username, product.stock, product.mark FROM product
        JOIN product_category ON product.category = product_category.id
        JOIN admin ON product.created_by = admin.id
    WHERE 1 = 1;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function fetchProduct(PDO $pdo, int $id): array
{
    $sql = "SELECT product.id, product.category, product.name, product.description, product.image_url AS image, product.price, product_category.name AS category_name, admin.username, product.stock, product.mark FROM product
        JOIN product_category ON product.category = product_category.id
        JOIN admin ON product.created_by = admin.id
    WHERE product.id = :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => $id]);
    return $stmt->fetch();
}

function deleteProduct(PDO $pdo, int $id): bool
{
    $sql = "DELETE FROM product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(["id" => $id]);
}

function addProduct(PDO $pdo, int $created_by, ?string $category, string $name, string $description, float $price, int $stock): bool
{
    $pdo->beginTransaction();

    if ($category == 'null')
        $category = null;

    try {
        $sql = "INSERT INTO product (created_by, category, name, description, price, stock) 
                VALUES (:created_by, :category, :name, :description, :price, :stock)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':created_by', $created_by, PDO::PARAM_INT);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception("Product insert failed");
        }

        $productId = $pdo->lastInsertId();

        if (!updateProductImage($pdo, (int)$productId)) {
            throw new Exception("Failed to update product image");
        }

        $pdo->commit();

        return true;

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
        return false;
    }
}


function updateProduct(PDO $pdo, int $id, ?int $category, string $name, string $description, float $price, int $stock, ?string $mark): bool
{
    $sql = "UPDATE product SET name = :name, description = :description, price = :price, stock = :stock, mark = :mark";

    if ($mark == null) {
        $mark = 0;
    } else {
        $mark = 1;
    }

    if ($category !== null) {
        $sql .= ", category = :category";
    }

    $sql .= " WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $stmt->bindParam(':mark', $mark, PDO::PARAM_INT);

    if ($category !== null) {
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
    }

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

function updateProductImage(PDO $pdo, int $id): bool
{
    require_once 'files.php';
    $image_url = '/images/' . uploadFile();

    if (!$image_url) {
        return false;
    }

    $sql = "UPDATE product SET image_url = :image_url WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

function fetchMarkedProducts(PDO $pdo): array
{
    $sql = "SELECT * FROM product WHERE mark = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function newestProducts(PDO $pdo): array
{
    $sql = "SELECT * FROM product ORDER BY id DESC LIMIT 5";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function orderProduct(PDO $pdo, int $id): void
{
    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("SELECT stock FROM product WHERE id = :id FOR UPDATE");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            $pdo->rollBack();
        }

        if ($product['stock'] <= 0) {
            $pdo->rollBack();
        }

        $stmt = $pdo->prepare("UPDATE product SET stock = stock - 1 WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $stmt = $pdo->prepare("insert into `order` (product_id) values (:id)");
        $stmt->execute(['id' => $id]);

        $pdo->commit();

    } catch (Exception $e) {
        $pdo->rollBack();
    }
}
