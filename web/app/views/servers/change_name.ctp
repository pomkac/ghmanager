<?php
/*
 * Created on 13.09.2010
 *
 * Made for project TeamServer(Git)
 * by bulaev
 */
 include('../loading_params.php');
?>
<div id="flash"><?php echo $session->flash(); ?></div>
<div id="change_server_name">

<?php echo $form->create('ServerCore', array( 'url' => '/servers/changeName')); ?>

<table border="0" cellpadding="0" cellspacing="2">
	<tr>
		<td>
		<div id="input_fieldname" class="highlight3">
			Имя сервера в панели:
		</div>
		<?php
		echo $form->input('name', array('div' => 'input_center', 
										'label' => false, 
										'title'=>'Введите имя сервера в панели',
										//'disabled'=>'disabled',
										'style'=>'width: 350px;'));
		 
		?>
		</td>
	</tr>
	<tr>
		<td>
		<div id="input_fieldname" class="highlight3">
			Имя сервера в игре и мониторинге:
		</div>
		<?php
		echo $form->input('nameInGame', array('div' => 'input_center', 
										'label' => false, 
										'title'=>'Введите имя сервера в игре',
										//'disabled'=>'disabled',
										'style'=>'width: 350px;'));
		 
		?>
		</td>
	</tr>
	<tr>
		<td>
		<div id="input_fieldname" class="highlight3">
			Краткое описание сервера:
		</div>
		<?php
		echo $form->input('desc', array( 'type'=>'textarea',
				  						 'wrap'=>'on',
				  						 'style'=> 'width: 340px;  
				  							  		height: 80px;
											  		padding-left: 10px;
											  	    margin-left: 3px;', 
										 'label' => false, 
										 'title'=>'Введите краткое описание сервера, которое будет отображаться в мониторинге на нашем сайте',
										 //'disabled'=>'disabled'
										));
		 
		?>
		<div id="input_fieldname">
			70 символов максимум
		</div>
		</td>
	</tr>
	<tr>
		<td align="center">
		<?php
		echo $form->input('id', array('type'=>'hidden'));
		// Пока неисправят баг в jQuery, будем отсылать обычной кнопкой
		echo $form->submit('Сохранить',
								array('class' => 'btn btn-primary'));
		?>
		</td>
	</tr>
</table>
<?php echo $form->end();?>

</div>
