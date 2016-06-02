<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output indent="yes" />

    <xsl:param name="test" select="'test-default'" />

    <xsl:template match="/">
        <xsl:variable name="demo">
            <p>hallo welt, <xsl:value-of select="$test" /></p>
        </xsl:variable>
        <root>
            <xsl:copy-of select="$demo" />
        </root>
    </xsl:template>

</xsl:stylesheet>
