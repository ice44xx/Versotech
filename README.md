# Teste Técnico de Conhecimentos em SQL

### Para iniciar o projeto use php -S localhost:8000 -t public

### 1. Consulta de Vendedores Ativos

```sql
SELECT id_vendedor AS id, nome, salario
FROM vendedores
WHERE inativo = false
ORDER BY nome ASC;
```

---

### 2. Funcionários com Salário Acima da Média

```sql
SELECT id_vendedor AS id, nome, salario
FROM vendedores
WHERE salario > (SELECT AVG(salario) FROM vendedores)
ORDER BY salario DESC;
```

---

### 3. Resumo por Cliente

```sql
SELECT
    c.id_cliente AS id,
    c.razao_social,
    COALESCE(SUM(p.valor_total), 0) AS total
FROM clientes c
LEFT JOIN pedido p ON c.id_cliente = p.id_cliente
GROUP BY c.id_cliente, c.razao_social
ORDER BY total DESC;
```

---

### 4. Situação por Pedido

```sql
SELECT
    id_pedido AS id,
    valor_total AS valor,
    data_emissao AS data,
    CASE
        WHEN data_cancelamento IS NOT NULL THEN 'CANCELADO'
        WHEN data_faturamento IS NOT NULL THEN 'FATURADO'
        ELSE 'PENDENTE'
    END AS situacao
FROM pedido;
```

---

### 5. Produto Mais Vendido

```sql
SELECT
    ip.id_produto,
    SUM(ip.quantidade) AS quantidade_vendida,
    SUM(ip.preco_praticado * ip.quantidade) AS total_vendido,
    COUNT(DISTINCT ip.id_pedido) AS pedidos,
    COUNT(DISTINCT p.id_cliente) AS clientes
FROM itens_pedido ip
JOIN pedido p ON p.id_pedido = ip.id_pedido
GROUP BY ip.id_produto
ORDER BY quantidade_vendida DESC, total_vendido DESC
LIMIT 1;
```
