/* CSS */
import "../css/app.css";
import "../assets/extensions/sweetalert2/sweetalert2.min.css";
import "../assets/compiled/css/extra-component-sweetalert.css";
import "../assets/compiled/css/app.css";
import "../assets/compiled/css/app-dark.css";
import "../assets/compiled/css/iconly.css";

/* JS */
import Swal from "sweetalert2";
window.Swal = Swal;
import "../assets/static/js/initTheme";
import "./bootstrap";
import "../../node_modules/preline/dist/preline";
import "boxicons";
import "../assets/static/js/components/dark";
import "../assets/static/js/pages/horizontal-layout";
import "../assets/extensions/perfect-scrollbar/perfect-scrollbar.min";
import "../assets/compiled/js/app";
import "../assets/static/js/pages/dashboard";
import jQuery from "jquery";
window.$ = jQuery;
import Chart from "chart.js/auto";
window.Chart = Chart;
import DataTable from "datatables.net-bs5";
DataTable(window, window.$);

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();
