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

class inkidWidgetGuiaTamanhos extends WP_Widget {
	
	/**
	 * Construtor
	 */
	public function inkidWidgetGuiaTamanhos() { parent::WP_Widget(false, $name = 'Guia de Tamanhos'); }
	
	/**
	 * Exibição final do Widget (já no sidebar)
	 *
	 * @param array $argumentos Argumentos passados para o widget
	 * @param array $instancia Instância do widget
	 */
	public function widget($argumentos, $instancia) {

		echo $argumentos['before_widget'];
		
		echo "<p><img style='float:left;vertical-align:middle;' src='" . get_template_directory_uri() . "/images/caixa-icon.png' />" . $instancia['texto_guia'] . "</p>"; ?>



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
		$widget['link_guia'] = $instancia['link_guia'];
		$widget['texto_guia'] = $instancia['texto_guia'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('texto_guia'); ?>">Texto de exibição:</label>
			<input id="<?php echo $this->get_field_id('texto_guia'); ?>" name="<?php echo $this->get_field_name('texto_guia'); ?>" type="text" value="<?php echo $widget['texto_guia']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link_guia'); ?>">Link do Widget:</label>
			<input id="<?php echo $this->get_field_id('link_guia'); ?>" name="<?php echo $this->get_field_name('link_guia'); ?>" type="text" value="<?php echo $widget['link_guia']; ?>" />
		</p>
		<?php
	}

}

class inkidWidgetDepoimentos extends WP_Widget {
	
	/**
	 * Construtor
	 */
	public function inkidWidgetDepoimentos() { parent::WP_Widget(false, $name = 'Depoimentos'); }
	
	/**
	 * Exibição final do Widget (já no sidebar)
	 *
	 * @param array $argumentos Argumentos passados para o widget
	 * @param array $instancia Instância do widget
	 */
	public function widget($argumentos, $instancia) {
		global $opt_select_testimonial_page;

		$pag_testimonial = return_testimonial_page();
		echo $argumentos['before_widget'];
		
 ?>		
 		<div id="slider-depoimentos">
 			<a href="<?php echo $pag_testimonial; ?>" title="Avaliações de nossos clientes"><div class="page-title"><h1>DEPOIMENTOS</h1></div></a>
			<ul class="deposlides">

				<?php

				$args = array(
								'status' => 'approve',
								'post_id' => $opt_select_testimonial_page, // use post_id, not post_ID
								'number' => $instancia['numero_depoimentos'],
							);
							$comments = get_comments($args);
							foreach($comments as $comment) : ?>
								
								<li class="depoimento widget">
									<p><i>"<?php echo $comment->comment_content; ?>"</i></p>
									<p class="autor"><b><?php echo $comment->comment_author; ?></b></p>
								</li>

						<?php endforeach; ?>

			</ul>
		</div>
	<?php

		echo $argumentos['after_widget'];
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
		$widget['numero_depoimentos'] = $instancia['numero_depoimentos'];

		if (!isset($widget['numero_depoimentos'])) {
			$widget['numero_depoimentos'] = 3;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('numero_depoimentos'); ?>">Número de depoimentos exibidos:</label>
			<input id="<?php echo $this->get_field_id('numero_depoimentos'); ?>" name="<?php echo $this->get_field_name('numero_depoimentos'); ?>" type="text" value="<?php echo $widget['numero_depoimentos']; ?>" />
		</p>
		<?php
	}

}

add_action('widgets_init', create_function('', 'return register_widget("inkidWidgetFormContato");'));
add_action('widgets_init', create_function('', 'return register_widget("inkidWidgetGuiaTamanhos");'));
add_action('widgets_init', create_function('', 'return register_widget("inkidWidgetDepoimentos");'));


?>