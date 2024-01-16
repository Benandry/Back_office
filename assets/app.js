/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";
import $ from "jquery";
// You can specify which plugins you need
import { Tooltip, Toast, Popover } from "bootstrap";
import jszip from "jszip";
import pdfmake from "pdfmake";
import DataTable from "datatables.net-bs5";
import "datatables.net-buttons-bs5";
import "datatables.net-buttons/js/buttons.colVis.mjs";
import "datatables.net-buttons/js/buttons.html5.mjs";
import "datatables.net-buttons/js/buttons.print.mjs";

// start the Stimulus application
import "./bootstrap";

$("#table-search").DataTable({
  buttons: ["copy", "excel", "pdf"],
  fixedHeader: true,
});
