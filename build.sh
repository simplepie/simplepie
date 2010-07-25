#!/bin/sh
cat SimplePie.php > SimplePie.compiled.php
find SimplePie -type f| xargs cat | sed 's/^<?php//g'>>SimplePie.compiled.php

