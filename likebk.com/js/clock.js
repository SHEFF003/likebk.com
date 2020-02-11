/*

	Copyright 2013 Arigato Software

	Скрипт цифровых часов на Canvas

*/

var DigitalClock = {
	
	// Параметры часов
	backColor: '#bbb8b6', // цвет фона
	darkColor: '#aca9a7', // цвет выключенного элемента
	lightColor: '#2b2938', // цвет включенного элемента
	lineWidth: 31, // толщина линий
	lineLength: 125, // длина линий
	lineWidthSmall: 18, // толщина линий
	lineLengthSmall: 57, // длина линий
	
	/*
		 -     0
		| |   1 2
		 -     3
		| |   4 5
		 -     6
	*/
	digits: [
		[1,1,1,0,1,1,1], // 0
		[0,0,1,0,0,1,0], // 1
		[1,0,1,1,1,0,1], // 2
		[1,0,1,1,0,1,1], // 3
		[0,1,1,1,0,1,0], // 4
		[1,1,0,1,0,1,1], // 5
		[1,1,0,1,1,1,1], // 6
		[1,0,1,0,0,1,0], // 7
		[1,1,1,1,1,1,1], // 8
		[1,1,1,1,0,1,1]  // 9
	],
	
	// Запуск часов
	start: function(canvasId) {
		var canvas = document.getElementById(canvasId);
		if ( canvas.getContext ) {
			var context = canvas.getContext('2d');
			this.context = context;
			var xScale = canvas.width / this.offset(30, 4);
			var yScale = canvas.height / this.offset(4, 2);
			context.scale(xScale, yScale);
			this.tick();
			setInterval(function(){DigitalClock.tick()}, 500);
		}
	},
	
	// Получить цвет элемента
	getColor: function(bool) {
		return ( bool ) ? this.lightColor : this.darkColor;
	},
	
	// � ассчитать смещение элемента
	offset: function(countWidth, countLength) {
		return countWidth * this.lineWidth + countLength * this.lineLength;
	},
	
	// � ассчитать смещение элемента
	offsetSmall: function(countWidth, countLength) {
		return countWidth * this.lineWidthSmall + countLength * this.lineLengthSmall;
	},
	
	// Отображение цифры на канве
	drawDigit: function(x, y, digit) {
		var ctx = this.context;
		
		ctx.save();
		ctx.translate(x, y);
		ctx.lineWidth = this.lineWidth;
		ctx.lineCap = 'round';
		
		// рисуем горизонтальные линии
		for (var i = 0; i < 3; i++) {
			var y = i * this.offset(1, 1);
			ctx.beginPath();
			ctx.strokeStyle = this.getColor(this.digits[digit][i*3]);
			ctx.moveTo(this.offset(1, 0), y);
			ctx.lineTo(this.offset(0, 1), y);
			ctx.stroke();
		}
		
		// рисуем вертикальные линии
		for (var j = 0; j < 2; j++) {
			var y = j * this.offset(1, 1);
			for (var i = 0; i < 2; i++) {
				var x = i * this.offset(1, 1);
				ctx.beginPath();
				ctx.strokeStyle = this.getColor(this.digits[digit][1+j*3+i]);
				ctx.moveTo(x, y + this.offset(1, 0));
				ctx.lineTo(x, y + this.offset(0, 1));
				ctx.stroke();
			}
		}
		
		ctx.restore();
	},
	
	// Отображение числа на канве
	drawNumber: function(x, y, number, digits) {
		x += this.offset(4, 1) * (digits - 1);
		for ( ; digits--; ) {
			this.drawDigit(x, y, number % 10);
			number = Math.floor(number / 10);
			x -= this.offset(4, 1);
		}
	},
	
	// Отображение цифры на канве
	drawDigitSmall: function(x, y, digit) {
		var ctx = this.context;
		
		ctx.save();
		ctx.translate(x, y);
		ctx.lineWidth = this.lineWidthSmall/4;
		ctx.lineCap = 'round';
		
		for (var ki = 0; ki < 10; ki++) {
				
			// рисуем горизонтальные линии
			for (var i = 0; i < 3; i++) {
				var y = i * this.offsetSmall(1, 1);
				ctx.beginPath();
				ctx.strokeStyle = this.getColor(this.digits[digit][i*3]);
				ctx.moveTo(this.offsetSmall(1, 0), y);
				ctx.lineTo(this.offsetSmall(0, 1), y);
				ctx.stroke();
			}
			
			// рисуем вертикальные линии
			for (var j = 0; j < 2; j++) {
				var y = j * this.offsetSmall(1, 1);
				for (var i = 0; i < 2; i++) {
					var x = i * this.offsetSmall(1, 1);
					ctx.beginPath();
					ctx.strokeStyle = this.getColor(this.digits[digit][1+j*3+i]);
					ctx.moveTo(x, y + this.offsetSmall(1, 0));
					ctx.lineTo(x, y + this.offsetSmall(0, 1));
					ctx.stroke();
				}
			}
		
		}
		
		ctx.restore();
	},
	
	// Отображение числа на канве
	drawNumberSmall: function(x, y, number, digits) {
		x += this.offset(4, 1) * (digits - 1) - 200;
		for ( ; digits--; ) {
			this.drawDigitSmall(x, y, number % 10);
			number = Math.floor(number / 10);
			x -= this.offsetSmall(4, 1);
		}
	},
	
	// Отрисовка часов
	tick: function() {
		// получаем текущее время
		var now = new Date();
		var hr = now.getHours();
		var mn = now.getMinutes();
		var sc = now.getSeconds();
		
		// выводим на канву
		this.context.fillStyle = this.backColor;
		this.context.fillRect(0, 0, this.offset(36, 7), this.offset(4, 2));
		this.drawNumber(this.offset(1, 0), this.offset(1, 0), hr, 2);
		this.drawNumber(this.offset(12, 2), this.offset(1, 0), mn, 2);
		this.drawNumberSmall(this.offset(23, 4), this.offset(1, 0), sc, 2);
		
		// рисуем точки
		this.context.beginPath();
		
		this.context.arc(this.offset(9, 2), this.offset(1.5, 0.5), this.lineWidthSmall, 0, 2 * Math.PI, true);
		this.context.arc(this.offset(9, 2), this.offset(2.5, 1.5), this.lineWidthSmall, 0, 2 * Math.PI, true);
		
		this.context.fillStyle = this.getColor(this.bbtcl);
		this.context.strokeStyle = this.backColor;
		this.context.lineWidth = 1;
		this.context.fill();
		this.context.stroke();
		if( this.bbtcl == 1 ) { this.bbtcl = 0; }else{ this.bbtcl = 1; }
	},
	bbtcl:1
	
};