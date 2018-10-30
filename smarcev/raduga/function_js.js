/*
* Функция по определению цвета в js*/
//присваиваем переменной вторую форму id=cf__fjs
let col=document.getElementById('cf__fjs');
//в форме переменной присваиваем набор элементов select
let col_sel=col.getElementsByClassName('colors__select');

//цикл по элементам select
for (let j = 0; j <col_sel.length ; j++) {
    //цикл по элементам option внутри select
    for (let i = 0; i < col_sel[j].options.length; i++) {
        //при выборе цвета из списка
        col_sel[j].addEventListener('click', function () {
            //если нажат элемент списка
            if (event.target.value) {
                //присваиваем переменной список значений данного select
                var option = col_sel[j].options[i];
                //если данный элемент имеет значение выбранного
                if (option.selected) {
                    //console.log('Я нажал ' + option.value);
                    //Ищем родительский элемент для селекта
                    var par_sel=col_sel[j].parentNode;
                    //и меняем имя класса для того чтобы поменялся цвет
                    par_sel.className='colors__first cf__'+option.value;

                }
            }
        }, false);

    }
}
