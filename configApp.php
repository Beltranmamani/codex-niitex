<?php
    const SERVER = "localhost";
    // const DB = "bolivia_bpos_bpos2"; //softsisp_bpos
    const DB = "bpos_git_oficial_7precios"; //softsisp_bpos
    // const USER = "transporteremoli_root";
    // const PASS = "88X5lJ4*YtD0"; 
    // const DB = "bpos"; //softsisp_bpos
    const USER = "root";
    const PASS = ""; 
    const SGDB = "mysql:host=".SERVER.";dbname=".DB;
    const SECRET_KEY = '$B_POS@2020';
    const SECRET_IV = '202001';
    const METHOD = "AES-256-CBC";