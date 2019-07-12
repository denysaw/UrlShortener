# Scaling

1. Vertical scaling:
- Would try to use `WebSockets'` requests instead of usual `HTTP` ones.
- Scale the environment vertically as much as it is possible (setting to `PHP-FPM`, `nginx`, `Redis` etc., choose better `VPS`).
- Optimize everything I can.
- Compile project with [HHVM](https://hhvm.com/).

2. Horizontal scaling:
- Would choose best `Load Balancer` by the performance/price pointer as `Amazon ELB` or at least with `Nginx Plus`.
- Set everything up to split highload across all available clusters.
- If I would save money on Load Balancers I would scale horizontally manually:
1. Ordered multiple Redis cloud servers.
2. In code I would add server prefix char on the beginning of slug, so I would definitely know what Redis server is storing that url.
3. I would store `last_redis_server_index` on a first Redis server and use that index with it's autoincrement to store new url (passed to be shortened) on each time `next` Redis server to spread load proportionally.