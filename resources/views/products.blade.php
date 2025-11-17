<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 40px; background-color: #f9fafb; }
        h1 { color: #111827; }
        table { width: 100%; border-collapse: collapse; background-color: #fff; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border-radius: 8px; }
        th, td { border: 1px solid #e5e7eb; padding: 12px 16px; text-align: left; }
        th { background-color: #f3f4f6; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .btn { padding: 5px 10px; border-radius: 4px; text-decoration: none; color: white; font-size: 14px; margin-right: 5px; }
        .btn-add { background-color: #10b981; display: inline-block; margin-bottom: 20px; }
        .btn-edit { background-color: #f59e0b; }
        .btn-delete { background-color: #ef4444; border: none; cursor: pointer; font-family: inherit; }
        .actions-form { display: inline; }
    </style>
</head>
<body>
    <h1>Meus Produtos</h1>
    
    <a href="{{ route('web.products.create') }}" class="btn btn-add">Adicionar Novo Produto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('web.products.edit', $product->id) }}" class="btn btn-edit">Editar</a>
                        
                        <form action="{{ route('web.products.destroy', $product->id) }}" method="POST" class="actions-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Apagar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum produto cadastrado ainda.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>