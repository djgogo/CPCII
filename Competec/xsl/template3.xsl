<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:import href="include.xsl" />

    <xsl:output indent="yes" />

    <xsl:template match="/">
        <root>
            <xsl:apply-templates select="/root/entry" />
        </root>
    </xsl:template>

    <xsl:template match="entry">
        <p><xsl:value-of select="@id" /></p>
    </xsl:template>

    <xsl:template match="entry[child]">
        <p title="{child}"><xsl:value-of select="@id" /></p>
    </xsl:template>

    <xsl:template match="entry[@id = '2']">
        <h1><xsl:value-of select="@id" /></h1>
        <xsl:apply-templates select="*" />
    </xsl:template>

</xsl:stylesheet>
