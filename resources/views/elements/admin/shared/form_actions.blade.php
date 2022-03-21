<div class="ls-actions-btn">
	<button class="ls-btn"><?php echo (preg_match("/create/", Route::getCurrentRoute()->getActionName())) ? "Criar" : "Atualizar"; ?></button>
	<a href="{{ $route_cancel }}" class="ls-btn-danger" onclic="history.back()">Cancelar</a>
</div>