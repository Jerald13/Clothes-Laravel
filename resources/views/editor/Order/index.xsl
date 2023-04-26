<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>Order List</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css/XSL.css" />
        <style>
        td {
          text-align:center;
        }
        </style>
      </head>
      <body>
        <div class="wrapper" style="color:Blue;">
          <h1>Order List</h1>
          <table>
            <tr>
              <th>ID</th>
              <th>UserName</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Shipping Address</th>
              <th>State</th>
              <th>City</th>
              <th>Post Code</th>
              <th>Order Total</th>
            </tr>
            <xsl:for-each select="orders/order">
              <tr>
                <td><xsl:value-of select="id"/></td>
                <td><xsl:value-of select="username"/></td>
                <td><xsl:value-of select="email"/></td>
                <td><xsl:value-of select="phone_number"/></td>
                <td><xsl:value-of select="shipping_address"/></td>
                <td><xsl:value-of select="state"/></td>
                <td><xsl:value-of select="city"/></td>
                <td><xsl:value-of select="post_code"/></td>
                <td><xsl:value-of select="order_total"/></td>
              </tr>
            </xsl:for-each>
          </table>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>