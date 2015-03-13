
<div id="usersServersIndex">
	<div class="ui padded grid">
		<div class="ui equal height stretched row">
		<div class="six wide white column">
			<div class="ui top attached block header" data-bind="visible: gameServers().length > 0">Игровые серверы</div>
			<div class="ui divided selection list" data-bind="visible: gameServers().length > 0, foreach: {data: gameServers, afterRender: defineSelected.bind($data, 'game')}">

				<div class="item" data-bind="event: {click: $root.setSelected.bind($data, 'game')}">
					<div class="ui tiny_gh image">
						<img data-bind="visible: Status.image, attr: {src: Status.image}" />
					    <img data-bind="visible: !Status.image ,attr: {src: '/img/icons/servers/big/' + $root.serverIcon(GameTemplate['name'])}" src="/img/personage01.png"/>
					</div>
					<div class="content top aligned" data-bind="template: {name: 'render-server-item'}"></div>
				</div>

			</div>
			<div class="ui top attached block header" data-bind="visible: voiceServers().length > 0">Голосовые серверы</div>
			<div class="ui divided selection list" data-bind="visible: voiceServers().length > 0">
		    	<!-- ko foreach: voiceServers -->
				<div class="item" data-bind="event: {click: $root.setSelected.bind($data, 'voice')}">
					<div class="ui mini_gh image">
					  <img src="/img/bigicons/mumble.png">
					</div>
					<div class="content" data-bind="template: {name: 'render-server-item'}"></div>
				</div>
		    	<!-- /ko -->
		    </div>
		    <div class="ui top attached block header" data-bind="visible: eacServers().length > 0">Серверы EAC</div>
			<div class="ui divided selection list" data-bind="visible: eacServers().length > 0">
		    	<!-- ko foreach: eacServers -->
				<div class="item" data-bind="event: {click: $root.setSelected.bind($data, 'eac')}">
					<div class="ui mini_gh image">
					  <img src="/img/bigicons/eac.png">
					</div>
					<div class="content">
						<div class="header">
							<span data-bind="text: '#' + Server.id"></span> <span data-bind="text: Server.name"></span>
							<span data-bind="text: GameTemplate.longname, visible: !Server.name"></span>
						</div>
						<div class="description" data-bind="visible: Server.address && Server.port">
							<span data-bind="text: Server.address + ':' + Server.port"></span>
						</div>
					    <div class="description">
					    	<span data-bind="text: GameTemplate.longname, visible: Server.name"></span>
					    </div>
					    <div style="margin-top: 5px;">
							<div class="ui small label" data-bind="visible: Eac.id && Server.initialised">
								<i data-bind="css: {'green' : Eac.active, 'black': Eac.active === false}" class="circle icon"></i> <span data-bind="text: Eac.active ? 'Работает' : 'Выключен'"></span>
							</div>
							<div class="ui small label">
								<i data-bind="css: {green: $root.daysLeft(Server.payedTill) == 'payed', red: $root.daysLeft(Server.payedTill) == 'nonpayed'}" class="circle icon"></i> <span data-bind="text: $root.daysLeft(Server.payedTill) == 'payed' ? 'Оплачен' : 'Не оплачен'"></span>
							</div>
					    </div>
					</div>
				</div>
		    	<!-- /ko -->
		    </div>
		</div>
		<div class="ten wide left aligned white column" id="indexRightColumn">
			<div data-bind="visible: renderSelected,
			                template: {if: selectedType(),
			                           name: 'render-template-' + selectedType()
									   }">

			</div>
		</div>
		</div>
	</div>
</div>

<div class="ui small modal" id="indexModal">
	<i class="close icon"></i>
	<div class="header"></div>
	<div class="content">
		<div class="image" style="display: none;"></div>
		<div class="description"></div>
	</div>
	<div class="actions">
		<div class="ui button">Отмена</div>
		<div class="ui green button">OK</div>
	</div>
</div>

<script type="text/html" id="render-server-item">
	<div class="header">
		<span data-bind="text: '#' + Server.id"></span> <span data-bind="text: Server.name"></span><span data-bind="text: GameTemplate.longname, visible: !Server.name"></span>
	</div>
	<div class="description" data-bind="visible: Server.address && Server.port"><span data-bind="html: '<b>Адрес:</b> ' + Server.address + ':' + Server.port"></span></div>
	<div class="description" data-bind="visible: Status.mapName, html: '<b>Карта:</b> ' + Status.mapName"></div>
    <div class="description"><span data-bind="visible: Server.slots, html: $root.showSlots(Server.slots, Status.numberOfPlayers)"></span></div>
    <div style="margin-top: 5px;">
    	<div class="ui small label" data-bind="visible: $root.daysLeft(Server.payedTill) == 'payed' && Server.initialised === false"><div class="ui active mini inline loader"></div> Установка</div>
	    <div class="ui small label" data-bind="visible: Server.status && Server.initialised"><i data-bind="css: $root.serverIconClass(Server.status)" class="circle icon"></i> <span data-bind="text: $root.serverStatus(Server.status)"></span></div>
		<div class="ui small label"><i data-bind="css: {green: $root.daysLeft(Server.payedTill) == 'payed', red: $root.daysLeft(Server.payedTill) == 'nonpayed'}" class="circle icon"></i> <span data-bind="text: $root.daysLeft(Server.payedTill) == 'payed' ? 'Оплачен' : 'Не оплачен'"></span></div>
    </div>
</script>

<script type="text/html" id="render-template-game">
	<div class="ui top attached block header">
		<img data-bind="attr: {src: '/img/icons/servers/big/' + serverIcon(renderedServer().GameTemplate['name'])}" src="/img/personage01.png"/>
		<div class="content">
			<span data-bind='text: "\"" + renderedServer().Server.name + "\"", visible: gameServers()[selectedServer()].Server.name'></span>
			<span data-bind='text: renderedServer().GameTemplate.longname'></span>
			<span data-bind="text: '(ID: ' + renderedServer().Server.id + ')'"></span>
			<br/>
			<span data-bind="visible: renderedServer().Server.address, text: renderedServer().Server.address + ':' + renderedServer().Server.port"></span>
		</div>
		<div class="ui active inline loader" data-bind="visible: loadingModal"></div>

	</div>
	<div class="ui bottom attached segment" data-bind="visible: !renderedServer().Server.initialised && renderedServer().Server.payedTill">
		<div class="ui active inline loader"></div> Идёт установка сервера, подождите немного.
	</div>
	<div class="ui labeled icon fluid menu attached" data-bind="visible: renderedServer().Server.initialised">
		<!-- Продление только для инициализированного сервера
		     Иконка для продления оплаты игрового сервера -->
		<a class="item" data-bind="event: {click: $root.showModal.bind($data, '', 'Продлить аренду сервера', '/orders/prolongate/' + renderedServer().Server.id)}, visible: gameServers()[selectedServer()].Server.initialised">
			<i class="add to cart icon"></i>Продлить
		</a>
		<a class="item" data-bind="event: {click: $root.showModal.bind($data, 'small', 'Изменить имя сервера', '/servers/changeName/' + renderedServer().Server.id)}">
			<i class="edit icon"></i>Имя сервера
		</a>
		<a class="item" data-bind="event: {click: $root.showModal.bind($data, '', 'Изменить параметры запуска сервера', '/servers/editStartParams/' + renderedServer().Server.id)}">
			<i class="setting icon"></i>Параметры
		</a>
		<a class="item" data-bind="event: {click: $root.showModal.bind($data, 'fullscreen', 'Изменить настройки сервера', '/servers/editParams/' + renderedServer().Server.id)}">
			<i class="file text icon"></i>Настройки
		</a>
		<a class="item" data-bind="event: {click: $root.showModal.bind($data, '', 'Установка модов и плагинов', '/servers/pluginInstall/' + renderedServer().Server.id)}">
			<i class="suitcase icon"></i>Плагины
		</a>
		<a class="item" data-bind="event: {click: $root.showModal.bind($data, 'large', 'Установка карт', '/servers/mapInstall/' + renderedServer().Server.id)}, visible: jQuery.inArray(renderedServer().GameTemplate['name'], ['css', 'cssv34', 'dods', 'tf', 'cs16', 'cs16-old']) != -1">
			<i class="bomb icon"></i>Карты
		</a>
	</div>
	<div class="ui bottom attached segment">
		<div class="ui grid">
			<div class="ui row">
				<div class="ui column">
					<div class="ui negative message" data-bind="visible: renderedServer().Server.crashCount > 0">
					С момента последнего запуска сервера было зафиксировано <span data-bind="text: Number(renderedServer().Server.crashCount)"></span> падений.<br/>Последнее падение было <span data-bind="text: moment(renderedServer().Server.crashTime).format('DD.MM.YYYY')"></span>
					</div>
					<div class="ui warning icon message" data-bind="visible: !renderedServer().Server.initialised && !renderedServer().Server.payedTill">
						<i class="info icon"></i>
						<div class="content">
							<div class="header">
							Сервер не оплачен.
							</div>
							<p>При отсутствии оплаты в течение 2-х недель с момента создания заказа, сервер и заказ будут удалены.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="ui equal height stretched row" data-bind="visible: renderedServer().Server.initialised">
				<div class="ui four wide column">
					<div class="ui vertical labeled icon fluid menu">
						<a class="active item" data-bind="visible: renderedServer().Server.status == 'exec_success'"><i class="orange stop icon"></i> Выключить</a>
						<a class="active item" data-bind="visible: renderedServer().Server.status == 'exec_success'"><i class="orange repeat icon"></i> Перезапустить</a>
						<a class="active item"><i class="file text icon"></i> Логи</a>
						<a class="active item"><i class="download icon"></i> Обновление</a>
					</div>
				</div>
				<div class="ui six wide column">
					<div data-bind="visible: renderedServer().Server.status == 'exec_success'">
						<div class="description" data-bind="visible: renderedServer().Status.mapName, html: '<b>Карта:</b> ' + renderedServer().Status.mapName"></div>
	    				<div class="description"><span data-bind="visible: renderedServer().Server.slots, html: $root.showSlots(renderedServer().Server.slots, renderedServer().Status.numberOfPlayers)"></span></div>
	    				<div class="ui small top attached header">Игроки</div>
	    				<div class="ui bottom attached basic segment" data-bind="visible: renderedServer().Status.numberOfPlayers == 0">
	    					На сервере нет игроков
	    				</div>
    				</div>
				</div>
				<div class="ui six wide column">
					<img data-bind="visible: renderedServer().Status.image, attr: {src: renderedServer().Status.image}" />
					<img data-bind="visible: renderedServer().Status.graphs['24h'], attr: {src: renderedServer().Status.graphs['24h']}" />
					<img data-bind="visible: renderedServer().Status.graphs['7d'], attr: {src: renderedServer().Status.graphs['7d']}" />
				</div>

			</div>
		</div>
	</div>
</script>

<script type="text/html" id="render-template-voice">

</script>

<script type="text/html" id="render-template-eac">

</script>

<script type="text/javascript">

	$('#indexModal').modal();

	var userServersViewModel = function(){
			this.gameServers = ko.observableArray(<?php echo @json_encode($serversGrouped['Game']); ?>);

			this.voiceServers = ko.observableArray(<?php echo @json_encode($serversGrouped['Voice']); ?>);

			this.eacServers = ko.observableArray(<?php echo @json_encode($serversGrouped['Eac']); ?>);

			this.selectedServer = ko.observable(false);
			this.selectedType   = ko.observable(false);
			this.renderedServer = ko.observableArray([]);

			this.loading      = ko.observable(false);
			this.loadingModal = ko.observable(false);
			this.errors       = ko.observableArray([]);


			moment.locale('ru');

			console.log(this.gameServers());
			console.log(this.voiceServers());
			console.log(this.eacServers());

			this.serverIcon = function(game){
				if (game == 'cs16' || game == 'cs16-old'){
					return 'cs16.png';
				} else if (game == 'css' || game == 'cssv34') {
					return 'css.png';
				} else {
					return '';
				}
			}

			this.serverStatus = function(status){
				if (status == 'stoped' || status == 'stopped') {
					return 'Выключен';
				} else if (status == 'update_started') {
					return 'Обновление';
				} else if (status == 'update_error' || status == 'exec_error') {
					return 'Ошибка';
				} else if (status == 'exec_success') {
					return 'Работает';
				} else {
					return 'Неизвестно'
				}

			};

			this.serverIconClass = function(status){
				if (status == 'stoped' || status == 'stopped') {
					return 'black';
				} else if (status == 'update_started') {
					return 'purple';
				} else if (status == 'update_error' || status == 'exec_error') {
					return 'red';
				} else if (status == 'exec_success') {
					return 'green';
				} else {
					return ''
				}

			};

			this.daysLeft = function(date){
				var left = moment().diff(date, 'days', true);
				if (left < 0){
					return 'payed';
				}
				else
				{
					return 'nonpayed';
				}
			}.bind(this);

			this.defineSelected = function(type, event, server){
				var self = this;

				if (self.selectedServer() === false){
					if (type == 'eac'){
						if (self.daysLeft(server.Server.payedTill) == 'payed'){
							self.selectedServer(self.eacServers().indexOf(server));
							self.selectedType('eac');
						}
					} else if (type == 'game') {
						if (server.Server.initialised === true
								&& self.daysLeft(server.Server.payedTill) == 'payed'){
							self.selectedServer(self.gameServers().indexOf(server));
							self.selectedType('game');
						}
					} else if (type == 'voice') {
						if (server.Server.initialised === true
								&& self.daysLeft(server.Server.payedTill) == 'payed'){
							self.selectedServer(self.voiceServers().indexOf(server));
							self.selectedType('voice');
						}
					}
				}

				return true;

			}.bind(this);

			this.setSelected = function(type, server, event){
				var self = this;

				if (type == 'eac'){
					self.selectedServer(self.eacServers().indexOf(server));
					self.selectedType('eac');
				} else if (type == 'game') {
					self.selectedServer(self.gameServers().indexOf(server));
					self.selectedType('game');
				} else if (type == 'voice') {
					self.selectedServer(self.voiceServers().indexOf(server));
					self.selectedType('voice');
				}


			}.bind(this);

			this.showSlots = function(serverSlots, players, data) {

				serverSlots = Number(serverSlots);

				if (serverSlots > 0 && players === undefined) {
					return '<b>Слотов:</b> ' + serverSlots;
				} else if (serverSlots > 0 && players >= 0) {
					if (players < serverSlots){
						return '<b>Игроков:</b> <span class="green">' + players + '/' + serverSlots + '</span>';
					} else {
						return '<b>Игроков:</b> <span class="red">' + players + '/' + serverSlots + '</span>';
					}
				}



				return true;
			}

			this.renderSelected = ko.computed(function() {
				var self = this;
				var newData = [];

				if (self.selectedServer() !== false)
				{
					type = self.selectedType();

					if (type == 'eac'){
						newData = self.eacServers()[self.selectedServer()];
					} else if (type == 'game') {
						newData = self.gameServers()[self.selectedServer()];
					} else if (type == 'voice') {
						newData = self.voiceServers()[self.selectedServer()];
					}

					self.renderedServer(newData);

					return true;
				}

		        return false;
		    }, this);

			this.showModal = function(size, title, bodyUrl, data){
				var self = this;

				$('#indexModal').removeClass('small large fullscreen').addClass(size);
				$('#indexModal .header').html(title);

				self.loadingModal(true);

				$.get( bodyUrl )
		    	 .done(
			    	 	function(data){

			    	 		$('#indexModal .content .description').html(data);
							$('#indexModal').modal('show');

							self.loadingModal(false);
						})
		    	 .fail( function(data, status, statusText) {
		    	 	answer = "HTTP Error: " + statusText;
		    	 	self.errors.push(answer);
		    	 	self.loadingModal(false);
		    	 });

			}.bind(this);

		};

	ko.applyBindings(new userServersViewModel(), document.getElementById("usersServersIndex"));
</script>



