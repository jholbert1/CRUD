import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Principal from './components/Principal/Principal'
import RegisterStudent from './components/Students/RegisterStudents'
import ShowStudent from './components/Students/ShowStudents'
import RegisterCourse from  './components/Courses/RegisterCourse'
import ShowCourse from  './components/Courses/ShowCourse'

const router = new Router({
    routes: [{
        name: "principal",
        path: "/",
        component: Principal,
        redirect: "register",
        props: true,
        children: [
            {
                name: "registerStudent",
                path: "register",
                component: RegisterStudent,
            },
            {
                name: "showStudent",
                path: "studentShow",
                component: ShowStudent,
            },
            {
                name: "registerCourse",
                path: "courseRegister",
                component: RegisterCourse,
            },
            {
                name: "showCourse",
                path: "courseShow",
                component: ShowCourse,
            }
        ]
    }],
    mode: "history"
});

export default router;
