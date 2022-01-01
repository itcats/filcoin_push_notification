##从币安API获取Filcoin价格推送给微信
---
**实现原理**

- [server酱](https://sct.ftqq.com/) 获取推送API
- [币安API](https://api.binance.com/api/v3/ticker/price?symbol=FILUSDT) 获取Filcoin当前价格
- Github Actions推送相关信息

**配置**

fork项目后,在自己的项目中设置secrets,name为:SEND_KEY,设置值为server酱得到的sendkey

**运行**

没两分钟构建一次actions,或当你更改代码后构建,当Filcoin价格大于100USDT，即触发消息推送