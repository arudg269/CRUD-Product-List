<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background-color: #f9fafb; }
        form { max-width: 500px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #3b82f6; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #2563eb; }
    </style>
</head>
<body>
    <form action="{{ route('web.products.store') }}" method="POST">
        @csrf
        <h1>Adicionar Novo Produto</h1>
        <div>
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="description">Descrição:</label>
            <input type="text" id="description" name="description">
        </div>
        <div>
            <label for="price">Preço:</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>