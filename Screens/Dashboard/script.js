"use strict";

import { destruirSessao } from '../../scripts/session.js'

document.getElementById("sair").addEventListener('click', destruirSessao);