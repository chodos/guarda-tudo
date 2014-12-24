<?php
/**
 * Creator Widgets Functions.
 *
 * @package InkID
 */

class inkidWidgetFormContato extends WP_Widget {
	
	/**
	 * Construtor
	 */
	public function inkidWidgetFormContato() { parent::WP_Widget(false, $name = 'Contato'); }
	
	/**
	 * Exibição final do Widget (já no sidebar)
	 *
	 * @param array $argumentos Argumentos passados para o widget
	 * @param array $instancia Instância do widget
	 */
	public function widget($argumentos, $instancia) {
		if (!is_page()) 
			return;

		echo $argumentos['before_widget'];
		echo $argumentos['before_title'] . $argumentos['widget_name'] . $argumentos['after_title'];
		
		echo "<span>" . $instancia['descricao_contato'] . "</span>"; ?>

		<form>
			<p><label for="FormWidgetName">Nome</label>
			<input type="text" name="nome" id="FormWidgetName"></p>
			<p><label for="FormWidgetMail">E-mail</label>
			<input type="text" name="mail" id="FormWidgetMail"></p>
			<p><label for="FormWidgetFone">Telefone</label>
			<input type="text" name="fone" id="FormWidgetFone"></p>
			<p><label for="FormWidgetMessage">Mensagem</label>
			<textarea type="text" name="mensagem" id="FormWidgetMessage"></textarea></p>
			<p style="text-align:right"><input class="botao" type="submit" name="envia_widget" value="<?php echo $instancia['botao_contato']; ?>"></p>
		</form>

		<?php echo $argumentos['after_widget'];
	}
	
	/**
	 * Salva os dados do widget no banco de dados
	 *
	 * @param array $nova_instancia Os novos dados do widget (a serem salvos)
	 * @param array $instancia_antiga Os dados antigos do widget
	 */
	public function update($nova_instancia, $instancia_antiga) {			
		$instancia = array_merge($instancia_antiga, $nova_instancia);
    	return $instancia;
	}
	
	/**
	 * Formulário para os dados do widget (exibido no painel de controle)
	 *
	 * @param array $instancia Instância do widget
	 */
	public function form($instancia) {	
		$widget['descricao_contato'] = $instancia['descricao_contato'];
		$widget['botao_contato'] = $instancia['botao_contato'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('descricao_contato'); ?>">Descrição:</label>
			<input id="<?php echo $this->get_field_id('descricao_contato'); ?>" name="<?php echo $this->get_field_name('descricao_contato'); ?>" type="text" value="<?php echo $widget['descricao_contato']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('botao_contato'); ?>">Texto botão:</label>
			<input id="<?php echo $this->get_field_id('botao_contato'); ?>" name="<?php echo $this->get_field_name('botao_contato'); ?>" type="text" value="<?php echo $widget['botao_contato']; ?>" />
		</p>
		<?php
	}

}

add_action('widgets_init', create_function('', 'return register_widget("inkidWidgetFormContato");'));


?>