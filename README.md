# ngix parser coding challenge

# Description

The challenge is to write a parser for an nginx log file in the format: 

"Our nginx.conf has this format for log entries 
log_format custom '$remote_addr $server_name $remote_user [$time_local] '
                          '"$request" $status $body_bytes_sent '
                          '"$http_referer" "$http_user_agent"';
 
Please write a program that parses nginx log and outputs html grid with German ip addresses only. Please add sort and search functionality to this grid."
