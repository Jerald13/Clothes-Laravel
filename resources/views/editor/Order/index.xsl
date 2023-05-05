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
              <th>Country</th>
              <th>Order Total (RM)</th>
              <th>Order Status</th>
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
                <td><xsl:value-of select="postcode"/></td>
                <td><xsl:value-of select="country"/></td>
                <td><xsl:value-of select="order_total"/></td>
                <td><xsl:value-of select="order_status"/></td>
              </tr>
            </xsl:for-each>
          </table>
          <p>There are <b style="color:black"><xsl:value-of select="count(orders/order)"/></b> order(s) inside this table</p>
          <p>The total amount sold for the order(s) in this table is <b style="color:black">RM <xsl:value-of select="sum(orders/order/order_total)"/></b></p>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>