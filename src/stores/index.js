import { defineStore } from 'pinia'

export const useTodoList = defineStore('usersFilters',{
    id: 'index',
    state: () => ({
        todoList: [
            {
                "0": 22,
                "1": "Форма",
                "2": "Создать форму для добавления новых задач.",
                "3": "2023-10-04",
                "4": 1,
                "id": 22,
                "name": "Форма",
                "title": "Создать форму для добавления новых задач.",
                "date": "2023-10-04",
                "statuses": 1
            },
            {
                "0": 31,
                "1": "Кнопка удалить",
                "2": "Реализовать кнопку для удаления задач",
                "3": "2023-10-07",
                "4": 0,
                "id": 31,
                "name": "Кнопка удалить",
                "title": "Реализовать кнопку для удаления задач",
                "date": "2023-10-07",
                "statuses": 0
            },
            {
                "0": 32,
                "1": "Vue",
                "2": "Использовать компоненты Vue.js для управления задачами и формой добавления задач",
                "3": "2023-10-14",
                "4": null,
                "id": 32,
                "name": "Vue",
                "title": "Использовать компоненты Vue.js для управления задачами и формой добавления задач",
                "date": "2023-10-14",
                "statuses": null
            },
            {
                "0": 33,
                "1": "Бэкенд (PHP)",
                "2": "Создать простой API для управления задачами (добавление, получение, обновление,\r\nудаление).",
                "3": "2023-10-07",
                "4": null,
                "id": 33,
                "name": "Бэкенд (PHP)",
                "title": "Создать простой API для управления задачами (добавление, получение, обновление,\r\nудаление).",
                "date": "2023-10-07",
                "statuses": null
            },
            {
                "0": 34,
                "1": "Хранение",
                "2": "Хранить задачи в массиве или простой базе данных (например, SQLite).",
                "3": "2023-10-02",
                "4": null,
                "id": 34,
                "name": "Хранение",
                "title": "Хранить задачи в массиве или простой базе данных (например, SQLite).",
                "date": "2023-10-02",
                "statuses": null
            },
            {
                "0": 35,
                "1": "Обрабатывать запросы",
                "2": "Обрабатывать запросы от фронтенда и возвращать соответствующие данные.",
                "3": "2023-11-04",
                "4": null,
                "id": 35,
                "name": "Обрабатывать запросы",
                "title": "Обрабатывать запросы от фронтенда и возвращать соответствующие данные.",
                "date": "2023-11-04",
                "statuses": null
            },
            {
                "0": 36,
                "1": "Статус кнопка",
                "2": "Добавить возможность переключения статуса задачи (выполнено/не выполнено).",
                "3": "2023-10-22",
                "4": null,
                "id": 36,
                "name": "Статус кнопка",
                "title": "Добавить возможность переключения статуса задачи (выполнено/не выполнено).",
                "date": "2023-10-22",
                "statuses": null
            },
            {
                "0": 37,
                "1": "Бэкенд для сохранения данных",
                "2": "Задачи должны сохраняться между сессиями (используйте браузерное хранилище или\r\nбэкенд для сохранения данных).",
                "3": "2023-10-27",
                "4": null,
                "id": 37,
                "name": "Бэкенд для сохранения данных",
                "title": "Задачи должны сохраняться между сессиями (используйте браузерное хранилище или\r\nбэкенд для сохранения данных).",
                "date": "2023-10-27",
                "statuses": null
            },
            {
                "0": 38,
                "1": "Дизайн",
                "2": "Создать простой дизайн для приложения, чтобы оно выглядело аккуратно и понятно",
                "3": "2023-10-20",
                "4": null,
                "id": 38,
                "name": "Дизайн",
                "title": "Создать простой дизайн для приложения, чтобы оно выглядело аккуратно и понятно",
                "date": "2023-10-20",
                "statuses": null
            },
            {
                "0": 39,
                "1": "Редактирование задач",
                "2": "Добавьте возможность редактирования задач.",
                "3": "2023-09-28",
                "4": null,
                "id": 39,
                "name": "Редактирование задач",
                "title": "Добавьте возможность редактирования задач.",
                "date": "2023-09-28",
                "statuses": null
            },
            {
                "0": 40,
                "1": "Сортировка",
                "2": "Реализуйте фильтрацию задач по статусу (выполнено/не выполнено),  (по дате добавления или статусу).",
                "3": "2023-10-14",
                "4": null,
                "id": 40,
                "name": "Сортировка",
                "title": "Реализуйте фильтрацию задач по статусу (выполнено/не выполнено),  (по дате добавления или статусу).",
                "date": "2023-10-14",
                "statuses": null
            },
        ],
        // todoList: [],
        checkboxChange: [],
        modal: false,
        modalItem: {},
        alert: false,
        alertOption: {
            type: '',
            message: ''
        },
        sort: false,
        sortItemValue: ''
    }),

    getters: {

        getTodoList(state){

            switch (state.sortItemValue) {
                
                case 'dateUp':
                case 'dateDown':

                    return this.getDateSort

                case 'statusesUp':
                case 'statusesDown':

                    return this.getStatusesFilter

                default:
                    
                    return state.todoList

            }
        },

        getDateSort(state){
            let res = []
            let dateSort = []

            dateSort = state.todoList.reduce((result, item) => {
                return result.includes(item.date)
                    ? result
                    : [...result, Date.parse(item.date)]
            }, [])

            dateSort.sort((a, b) => {
                return state.sortItemValue === 'dateDown' ? b - a : a - b
            })

            let noDoubleId = {}
            dateSort.forEach((el) => {
                for (let i in state.todoList) {
                    if (el === Date.parse(state.todoList[i].date)) {
                        if(typeof noDoubleId[state.todoList[i].id] === 'undefined') {
                            res.push(state.todoList[i])
                            noDoubleId[state.todoList[i].id] = true
                        }
                    }
                }
            })

            return res
        },

        getStatusesFilter(state){
            if(state.sortItemValue === 'statusesUp'){
                return state.todoList.filter(item => (item.statuses && +item.statuses === 1))
            }
            else {
                return  state.todoList.filter(item => !item.statuses || false)
            }
        }
    },

    actions: {
        async actionTodoListFetch(body = {}) {
            try {
                 await fetch('php/controller/PostController.php', this._fetchInit(body))
                    .then(response => response.json())
                    .then(result => {

                        this.todoList = result.data
                        this.alertOption.type = result?.type
                        this.alertOption.message = result?.message
                        this.__dataReset()

                    })

            } catch (error) {

                this.alertOption.type = 'error'
                this.alertOption.message = error
                return false

            }
        },

        _fetchInit(body){

            let init = {
                method: 'POST',
            }

            if(body.actions === 'edit' || body.actions === 'delete'){

                init.headers = {'Content-Type': 'application/json;charset=utf-8'}
                init.body = JSON.stringify(body)

            }
            else {
                init.body = body
            }

            // return JSON else formData
            return init

        },

        actionCheckboxChange(id){

            if(Array.isArray(id)){

                this.checkboxChange = id

            }
            else {
                if (this.checkboxChange.length) {

                    const inx = this.checkboxChange.indexOf(String(id))

                    if (inx !== -1) return this.checkboxChange.splice(inx, 1)

                }

                this.checkboxChange.push(String(id))
            }
        },

        actionModalSwitch(item = {}){

            this.modal = !this.modal

            if(Object.keys(item).length){

                const dbColumns = ['id', 'name', 'title', 'date']

                dbColumns.forEach(key => this.modalItem[key] = item[0][key])

            } else {

                this.modalItem = {}

                if(this.alert) {

                    this.alert = false
                    this.alertOption = {}

                }
            }

        },

        actionSortItemClick(id){

            this.sortItemValue = id

        },

        actionSortSwitch(){

            this.sort = !this.sort

        },
        __dataReset(){

            document.querySelectorAll('.checkbox__input').forEach(el => {
                if(el.checked) el.checked = false
            })
            this.checkboxChange = []
            this.sortItemValue = ''

        }
    }
})