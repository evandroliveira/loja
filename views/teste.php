<?php
    session_start();

    if (!isset( $_SESSION['itens'] ) ) :
        $_SESSION['itens'] = array();
    endif;
    
    if ( isset( $_GET['add'] ) && $_GET['add'] == "carrinho" ) :
        $idProduto  = $_GET['id'];
        if (!isset ($_SESSION['itens'][$idProduto])) :
            $_SESSION['itens'][$idProduto] = 1;
        else:
            $_SESSION['itens'][$idProduto] +=1;
        endif;
    endif;
    
    if ( count( $_SESSION['itens'] ) == 0 ) :
        echo ' <h1>Carrinho vazio</h1>';
    else:
        $_SESSION['dados'] =array();
        $conexao = new PDO ('mysql:host=localhost;dbname=meusprodutos',"root", "");
?>

<table >
    <thead>
        <th>Nome</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Subtotal</th>
        <th>Opções</th>

    </thead>
    <tbody>
<?php 
        $totalcarrinho = 0;
        foreach ( $_SESSION['itens'] as $idProduto => $quantidade ) :            
            $select = $conexao->prepare("SELECT * FROM produtos WHERE id=?");
            $select ->bindParam(1, $idProduto);
            $select ->execute();
            $produtos = $select->fetchAll();
            $total = $quantidade * $produtos[0]["preco"];
            if(count( $_SESSION['itens'] ) == 0 ) :
                $totalcarrinho = 0;
            else:
            
                $tempcarrinho = $totalcarrinho;
                $totalcarrinho =  $tempcarrinho + $total;
            
            endif;

?>
    <tr>
        <td><div align="center" style="font-size:20px; font-family: verdana"> <font color="black"><?=$produtos[0]["nome"]?></font> </div></td>
        <td><?=number_format( $produtos[0]["preco"], 2, ", ", "." )?></td>
        <td><div align="center"><a href="remover.php?remover=carrinho&id=<?=$idProduto?>">◄</a> <?=$quantidade?><a href="carrinho.php?add=carrinho&id=<?=$idProduto?>">►</a> </div></td>
        <td><?=number_format( $total, 2, ",", "." )?></td>
       <td>
  <a href="remover2.php?remover=carrinho&id=<?=$idProduto?>">Remover</a>
  
</td>
    </tr>

<?php
    array_push($_SESSION['dados'],
        array ('id_produto' => $produtos[0]["nome"],
                'quantidade' => $quantidade,
                'preco' => $produtos[0]["preco"],
                'total' => $total

    )
    );
    
        endforeach;
    

?>
    </tbody>
</table>
<table>
    <td><div align='center' style='font-size:25px;font-family:Verdana'>Total <?=number_format( $totalcarrinho, 2, ",", "." )?></div></td> 
    </table>
<?php
echo '<a href="finalizar.php"><button class="button2" type="submit">Finalizar pedido</button></a>';
    
    endif;
    
?>