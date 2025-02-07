#!/bin/bash
set -e

# Elimina el PID de Apache si existe para evitar bloqueos
rm -f /var/run/apache2/apache2.pid

# Inicia Apache en modo foreground
exec apache2-foreground
